<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {


	public function index()
	{
		$tableName = "user";

		$this->load->model('Basic');

		$table = $this->Basic->getTableRecords($tableName);
		$fields = $this->Basic->getTableFields($tableName);

		$results['records'] = $table;
		$results['fields'] = $fields;
		
		$this->load->view("header");
		$this->load->view("nav");
		$this->load->view("table", $results);
		$this->load->view("footer");
	}
}
