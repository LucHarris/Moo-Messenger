<?php

    class User extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database("default",TRUE);
        }

		public function getRecord($userId = "no user id provided")
		{
			$this->db->where('id',$userId);
			$query = $this->db->get('user');
			return $query->row();
		}
		//requires sanitising
		public function get($field, $value, $hideRemoved = true)
		{
			//todo change name to username
			
			$this->db->where($field,$value);
			
			if($hideRemoved)
			{
				$this->db->where('removed =', 0 );
			}

			$query = $this->db->get('user');

			//$query = $this->db->query("SELECT * FROM user WHERE ".$field."=\"".$validUser."\"");
			$data = $query->row();
			
			return $data;
		}

		public function validate($email,$password)
		{
			$email = filter_var($email, FILTER_SANITIZE_STRING); // done in 
			$password = filter_var($password, FILTER_SANITIZE_STRING); // email sanitised in $this->get()
			//query

			
			$this->db->where('email', $email); //password comes later
			$query = $this->db->get("user");

			//validate
			if($query->num_rows() == 1)
			{
                $row = $query->row();

				$storedPassword = $row->password;

				return password_verify($password, $storedPassword); 
				//return $storedPassword == $password;
			}
			else 
			{
				return false;
			}
		}

		//Updates the last action time and date
		public function updateLive()
		{
			if($this->session->id)
			{
				$now = date('Y-m-d H:i:s');
				$this->db->set('lastActive', $now);
				$this->db->where('id', $this->session->id);
				$this->db->update('user');
			}
		}

		public function create($newUser)
		{
			$this->db->insert('user', $newUser);

            return ($this->db->affected_rows() >0)?true:false; //todo simplify to just a condition statement
		}

		private function getPmList()
        {
            if($this->session->id)
            {
                $user = $this->session->id;


                $select = "
				SELECT otherUserDT.otherUserId,   
					otherUserDT.otherForename,    
					otherUserDT.otherSurname,  
					linkchatuser.chatId,
					otherUserDT.iconId, 
					otherUserDT.iconColour,
					CASE WHEN linkchatuser.userLastAccessed < recentMessageDT.recentMessageDate THEN 1 ELSE 0 END AS unread";
                $from = " FROM   user
                    LEFT JOIN linkchatuser ON user.id = linkchatuser.userId
                    LEFT JOIN chat ON linkchatuser.chatId = chat.id
                    LEFT JOIN (SELECT link.chatId, otherUser.id AS otherUserId, otherUser.forename AS otherForename, otherUser.surname AS otherSurname, otherUser.iconId, otherUser.iconColour
                                FROM linkchatuser AS link
                                LEFT JOIN user AS otherUser ON link.userId = otherUser.id
                                  WHERE link.removed = 0 AND otherUser.removed = 0) AS otherUserDT ON chat.id = otherUserDT.chatId
                    LEFT JOIN (SELECT message.chatId, MAX(message.creationDate) AS recentMessageDate 
                               FROM message 
                               WHERE message.removed = 0) AS recentMessageDT ON chat.id = recentMessageDT.chatId ";
                $where = "WHERE user.id = ".$user." AND (chat.name IS NULL OR chat.name = '')
                    AND chat.removed = 0
                    AND linkchatuser.removed = 0
                    AND user.id <> otherUserDT.otherUserId
                    AND linkchatuser.userAddedDate <= CURRENT_TIMESTAMP()
                    AND (linkchatuser.userLeaveDate > CURRENT_TIMESTAMP()   OR linkchatuser.userLeaveDate IS NULL)";

                
                $query = $this->db->query($select.$from.$where);

                $data = $query->result_array();

                return $data;
            }
            else
            {
                return array();
            }
        }

		private function getTeamList()
		{
			if($this->session->id)
			{
				$user = $this->session->id;

				$select = "
				SELECT chat.id AS chatId, 
				chat.name AS chatName, 
				chat.iconId, 
				chat.iconColour, 
				CASE WHEN linkchatuser.userLastAccessed < recentMessageDT.recentMessageDate THEN 1 ELSE 0 END AS unread ";
				$from = "FROM 	user 
						LEFT JOIN linkchatuser 	ON user.id = linkchatuser.userId 
						LEFT JOIN chat		ON chat.id = linkchatuser.chatId
						LEFT JOIN (SELECT message.chatId, MAX(message.creationDate) AS recentMessageDate FROM message WHERE message.removed = 0) AS recentMessageDT
							ON chat.id = recentMessageDT.chatId ";
				$where = "WHERE user.id = ".$user." 
						AND user.removed = 0 
						AND linkchatuser.removed = 0
						AND chat.removed = 0
						AND (linkchatuser.userLeaveDate > CURRENT_TIMESTAMP() OR linkchatuser.userLeaveDate IS NULL)
						AND (chat.name IS NOT NULL OR chat.name <> '') ";


				$query = $this->db->query($select.$from.$where);

                $data = $query->result_array();

                return $data;
			}
		}

		public function updateContactLists()
		{
			if($this->session->id)
			{
				//todo find out if this is required
				$this->session->unset_userdata('pmList'	);
				$this->session->unset_userdata('teamList'	);
	
				//retrieve contact lists
				$contactLists = array(
					'pmList' => $this->User->getPmList(),
					'teamList' => $this->User->getTeamList()
				);
	
				//assign to session
				$this->session->set_userdata($contactLists);
			}

			
		}

		//excludes password
		//Filtered in controller
		public function edit($updateDetails)
		{
			//password not here
			foreach($updateDetails AS $field => $value)
			{
				$this->db->set($field,$value);
			}
			$this->db->where('id',$this->session->id);
			$this->db->where('removed =', "0");
			
			$this->db->update('user');
			
			return ($this->db->affected_rows() === 1);

		}

		public function verifyPassword($password)
		{

			$this->db->where('id', $this->session->id);
			$this->db->where('removed =', "0");
			$query = $this->db->get('user');

			//validate
			if($query->num_rows() == 1)
			{
                $row = $query->row();

				$storedPassword = $row->password;

				return password_verify($password, $storedPassword); 
			}
			else 
			{
				return false;
			}
		}

		//User id based on logged in user and filters value
		public function updateElementInRecord($field, $value)
		{

			$this->db->set($field, $value);
			$this->db->where('id', $this->session->id);
			$this->db->where('removed =', "0");
			$this->db->update('user');

			return ($this->db->affected_rows() === 1);

		}

	}


?>
