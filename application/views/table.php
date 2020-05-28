


<?php
	//Field names passed in as "fields"
	//records passed in as "records"

    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->helper('url'); //For base URL

	echo "<table>";
	echo "<tr>";

	//Table headers
	foreach ($fields as $field)
	{
	   echo "<th>$field </th>" ;
	}
	echo "</tr>";

	//Records
	foreach($records as $row)
	{
		echo "<tr>";
		foreach ($row as $element)
		{ 
			echo "<th>$element </th>";
		}
		echo "</tr>";
	}
	echo "</table>";
?>


