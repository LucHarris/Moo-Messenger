<?php

    class Chat_Model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database("default",TRUE);
        }

        public function get($chatId)
        {
            $queryString = 
            "
            SELECT *
            FROM chat
            WHERE 
                chat.id = ".$chatId." 
                AND chat.removed = 0
            ";

            $query = $this->db->query($queryString);
            $data = $query->row();
            return $data;
        }

        public function userHasAccess($userId, $chatId)
        {

            //run must be validation in controller

            $queryString = "
                SELECT id, userId, chatId
                FROM linkchatuser
                WHERE userId = ".$userId." 
                    AND chatId=".$chatId."
                    AND  userAddedDate <= CURRENT_TIMESTAMP()
                    AND (userLeaveDate > CURRENT_TIMESTAMP() OR userLeaveDate IS NULL)
                    AND linkchatuser.removed = 0";
            
            $query = $this->db->query($queryString);

            return ($query->num_rows() > 0);

        }

        public function getMessagesInChat($chatId)
        {
            //chatId must be filtered in controller

            //userId
            //forename
            //surname
            //messageBody
            //postedDate
            //editedDate

            $queryString = "
            SELECT 
                user.id AS 'userId', 
                user.forename, 
                user.surname, 
                CASE WHEN message.removed = 0 THEN message.text ELSE NULL END AS 'messageBody', 
                message.creationDate AS 'postedDate',
                message.editedDate
            FROM user 
                RIGHT JOIN message ON user.id = message.userId
                LEFT JOIN chat ON chat.id = message.chatId 
                LEFT JOIN linkchatuser ON linkchatuser.id = chat.id
            WHERE chat.id = ".$chatId."  
                 AND user.removed = 0
                AND chat.removed = 0
                AND linkchatuser.removed = 0
            ORDER BY  message.creationDate
            ";

            $query = $this->db->query($queryString);
            $data = $query->result_array();
            return $data;
        }

        public function getOtherUsers($chatId)
        {
            //chatId must be filtered in controller
            $queryString= 
            "
            SELECT 
                user.id AS 'otherId', 
                user.email AS 'otherEmail', 
                user.forename AS 'otherForename', 
                user.surname AS 'otherSurname'
            FROM user
                JOIN linkchatuser ON  linkchatuser.userId = user.id
                JOIN chat  ON linkchatuser.chatId = chat.id
            WHERE 
                    user.id != ".$this->session->id." 
                AND chat.id = ".$chatId." 
                AND chat.removed = 0
                AND user.removed = 0
            ";

            $query = $this->db->query($queryString);
            $data = $query->result_array();
            return $data;
        }

        
    }

?>