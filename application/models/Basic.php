<?php

    class Basic extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database("default",TRUE);
        }

		public function getTableRecords($tableName)
        {
            $query = $this->db->query("SELECT * FROM $tableName");
            $data = $query->result_array();
            return $data;
        }

		public function getTableFields($tableName)
		{
			$fields = $this->db->list_fields($tableName);
			return $fields;
		}
    }


?>
