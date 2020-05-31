<?php

    class User extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database("default",TRUE);
        }

		public function get($field, $name)
		{
			//todo change name to username
			$validUser = filter_var($name, FILTER_SANITIZE_STRING);
			
			$query = $this->db->query("SELECT * FROM user WHERE ".$field."=\"".$validUser."\"");
			$data = $query->row();
			
			return $data;
		}

		public function validate($email,$password)
		{
			$email = filter_var($email, FILTER_SANITIZE_STRING);
			$password = filter_var($password, FILTER_SANITIZE_STRING);
			//query

			$this->db->where('email', $email); //password comes later
			$query = $this->db->get("user");

			//validate
			if($query->num_rows() == 1)
			{
                $row = $query->row();

				$storedPassword = $row->password;

				//return password_verify($password, $pw); //todo password validation
				return $storedPassword == $password;
				//return true;
			}
			else 
			{
				return false;
			}
		}

		//Updates the last action time and date
		public function update()
		{
			if($this->session->id)
			{
				$id = $this->session->userdata('id');
				$now = date('Y-m-d H:i:s');
				$this->db->set('lastActive', $now);
				$this->db->where('id', $id);
				$this->db->update('user');
			}
		}

		public function create($newUser)
		{
			$this->db->insert('user', $newUser);

            return ($this->db->affected_rows() >0)?true:false; //todo simplify to just a condition statement
		}


	}


?>
