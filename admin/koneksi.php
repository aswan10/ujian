<?php

class Database {

	// INITIALIZE VARIABLES
	var $database_connection;		// VARIABLE REPRESENTING DATABASE LINK IDENTIFIER
	// var $log_stats;				// VARIABLE DETERMINING WHETHER QUERY INFO SHOULD BE LOGGED
	// var $query_stats;			// ARRAY CONTAINING RELEVANT INFORMATION ABOUT QUERIES RUN

	// THIS METHOD CONNECTS TO THE SERVER AND SELECTS THE DATABASE
	// INPUT: $database_host REPRESENTING THE DATABASE HOST
	//	  $database_username REPRESENTING THE DATABASE USERNAME
	//	  $database_password REPRESENTING THE DATABASE PASSWORD
	//	  $database_name REPRESENTING THE DATABASE NAME
	// OUTPUT: 
	function database($database_host, $database_username, $database_password, $database_name) {
	
	  $this->database_connection = $this->database_connect($database_host, $database_username, $database_password, $database_name);
	} // END ee_database() METHOD

	
	// THIS METHOD CONNECTS TO A DATABASE SERVER
	// INPUT: $database_host REPRESENTING THE DATABASE HOST
	//	  $database_username REPRESENTING THE DATABASE USERNAME
	//	  $database_password REPRESENTING THE DATABASE PASSWORD
	// OUTPUT: RETURNS A DATABASE LINK IDENTIFIER
	function database_connect($database_host, $database_username, $database_password, $database_name) {

	  return mysqli_connect($database_host, $database_username, $database_password, $database_name);
	} // END database_connect() METHOD

	
	// THIS METHOD QUERIES A DATABASE
	// INPUT: $database_query REPRESENTING THE DATABASE QUERY TO RUN
	// OUTPUT: RETURNS A DATABASE QUERY RESULT RESOURCE
	function db_query($database_query) {
	  //$query_timer_start = getmicrotime();
	  return mysqli_query($this->database_connection, $database_query); 
	  
	  
	 /* if($this->log_stats != 0) {
	    $query_time = round(getmicrotime()-$query_timer_start, 5);
	    $this->query_stats[] = Array('query' => $database_query,
					'time' => $query_time);
	  } */

	 

	} // END database_query() METHOD


	// THIS METHOD CREATES A PREPARED STATEMENT
	
	/* function database_prepare($sql) {
		return new ee_statement($this, $sql);
	}
	*/
	
	
	// THIS METHOD FETCHES A ROW AS A NUMERIC ARRAY
	// INPUT: $database_result REPRESENTING A DATABASE QUERY RESULT RESOURCE
	// OUTPUT: RETURNS A NUMERIC ARRAY FOR A DATABASE ROW
	function db_fetch_array($database_result) {
		return mysqli_fetch_array($database_result);
	} // END database_fetch_array() METHOD


	// THIS METHOD FETCHES A ROW AS AN ASSOCIATIVE ARRAY
	// INPUT: $database_result REPRESENTING A DATABASE QUERY RESULT RESOURCE
	// OUTPUT: RETURNS AN ASSOCIATIVE ARRAY FOR A DATABASE ROW
	function db_fetch_assoc($database_result) {
		return mysqli_fetch_assoc($database_result);
	} // END database_fetch_assoc() METHOD

	// THIS METHOD RETURNS THE NUMBER OF ROWS IN A RESULT
	// INPUT: $database_result REPRESENTING A DATABASE QUERY RESULT RESOURCE
	// OUTPUT: RETURNS THE NUMBER OF ROWS IN A RESULT
	function db_num_rows($database_result) {
	  return mysqli_num_rows($database_result);
	} // END database_num_rows() METHOD

	
	function db_escape_string($database_result) { 
		return mysqli_real_escape_string($database_result);
	} // END database_escape_string() METHOD
	
	// THIS METHOD RETURNS THE NUMBER OF ROWS IN A RESULT
	// INPUT: $database_result REPRESENTING A DATABASE QUERY RESULT RESOURCE
	// OUTPUT: RETURNS THE NUMBER OF ROWS IN A RESULT
	//function database_affected_rows($database_result) {
	//  return mysql_affected_rows($database_result);
	//}
	function db_affected_rows() {
	  return mysqli_affected_rows($this->database_connection);
	}

	// END database_affected_rows() METHOD 

	// THIS METHOD RETURNS THE ID GENERATED FROM THE PREVIOUS INSERT OPERATION
	// INPUT: 
	// OUTPUT: RETURNS THE ID GENERATED FROM THE PREVIOUS INSERT OPERATION
	function db_insert_id() {
	  return mysqli_insert_id($this->database_connection);
	} // END database_insert_id() METHOD
	
	function db_num_fields($database_result) {
	  return mysqli_num_fields($database_result);
	}

	function db_field_name($database_result, $index) {
	  return mysql_field_name($database_result, $index);
	}

	function db_fetch_row($database_result) {
	  return mysqli_fetch_row($database_result);
	}

	// THIS METHOD RETURNS THE DATABASE ERROR
	// INPUT: 
	// OUTPUT: 
	function db_error() {
	  return mysqli_error($this->database_connection);
	} // END database_error() METHOD
	

	// THIS METHOD CLOSES A CONNECTION TO THE DATABASE SERVER
	// INPUT: 
	// OUTPUT: 
	function db_close() {
	  return mysqli_close($this->database_connection);
	} // END database_close() METHOD


}

 	$database_host = "localhost";
    $database_username = "root";
    $database_password = "";
    $database_name = "db_ujian";

    $db = new Database($database_host, $database_username, $database_password, $database_name);


?>