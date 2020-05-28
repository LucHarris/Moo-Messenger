<?php

    class User extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database("default",TRUE);
        }

		public function get($name)
		{
			//todo change name to username
			$validUser = filter_var($name, FILTER_SANITIZE_STRING);

			
			$query = $this->db->query("SELECT * FROM user WHERE name=\"".$validUserId."\"");
			$data = $query->row();
			
			return $data;
		}

		public function validate($name)
		{
			$name = filter_var($username, FILTER_SANITIZE_STRING);

			//query
			$this->db->where('name', $name);
			$query = $this->db->get("user");

			//validate
			if($query->num_rows() == 1)
			{
                $row = $query->row();

				//todo password validation (refer to models/User.php)

				return true;
			}
			else 
			{
				return false;
			}
		}
	}


?>
