<?php

class Database {
	
	private $mysqli;
	private $query_count = 0;
	private $last_query;
	private $last_result;
	
	public function __construct() {
		
		// Ensure Connection Constants are Defined
		if (!defined('DB_HOST')) { 
//			System::CriticalError('100', 'Undefined Database Host');
		}
		if (!defined('DB_USER')) { 
//			System::CriticalError('101', 'Undefined Database Username');
		}
		if (!defined('DB_PASSWORD')) { 
//			System::CriticalError('102', 'Undefined Database Password');
		}
		if (!defined('DB_NAME')) { 
//			System::CriticalError('103', 'Undefined Database Name');
		}
		
		// Instantiate Database Object or Produce Error
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if ($this->mysqli->connect_error) {			
			die('db error');
//			System::CriticalError('104', 'Database Connection Error ('.$this->mysqli->connect_errno . ') '.$this->mysqli->connect_error);
		}
		
	}
	
	/**
	 * Method to run a query on the database.<br />
	 * Returns false and produces a warning error in the event of a database error.
	 * 
	 * @param String $query Properly Formatted Mysql Query
	 * @return boolean|mysqli_result Results of Given Query
	 */
	
	public function query($query) {
		
		$this->query_count++;
		$result = $this->mysqli->query($query);
		
		if ($this->mysqli->error) {
//			System::WarningError('105', 'Database Error ('.$this->mysqli->errno . ') '.$this->mysqli->error.'<br />Query: '.$query);
			die('Database Error ('.$this->mysqli->errno . ') '.$this->mysqli->error.'<br />Query: '.$query);
			return false;
		} else {
			$this->last_query = $query;
			$this->last_result = $result;
			return $result;
		}
		
	}
	
	/**
	 * Perform a generic select query on the database.<br />
	 * Returns query data as an array, one array item per row.<br />
	 * Each array item can be an object or associative array, depending on the second parameter.
	 * 
	 * @param String $query Properly Formatted Mysql Query
	 * @param boolean $assoc If true, return data as associative arrays. Otherwise, return as objects.
	 * @return boolean|array Results of Given Query
	 */
	public function select($query, $assoc=false) {
		
		$return = array();
		$result = $this->query($query);
		if (!$result) { return array(); }
		
		if ($assoc) {
			while ($r = $result->fetch_assoc()) { $return[] = $r; }
		} else {
			while ($r = $result->fetch_object()) { $return[] = $r; }
		}
		
		return $return;
		
	}
	
	/**
	 * Select one row from the database.<br />
	 * Returns the first row of the given query.<br />
	 * LIMIT 1 should be included in the query for performance.<br />
	 * Data is returned in same was as select()
	 * 
	 * @param String $query Properly Formatted Mysql Query
	 * @param boolean $assoc If true, return data as associative array. Otherwise, return as object.
	 * @return boolean|array Results of Given Query
	 */
	public function one_row($query, $assoc=false) {
		
		$return = array();
		$result = $this->query($query);
		if (!$result) { return array(); }
		
		if ($assoc) {
			$return = $result->fetch_assoc();
		} else {
			$return = $result->fetch_object();
		}
		
		return $return;
		
	}
	
	/**
	 * Counts number of rows for a given query.
	 * Note: The given query must SELECT count(*) for the function to work.
	 * 
	 * @param String $query Properly Formatted Mysql Query
	 * @return boolean|int Number of Rows
	 */
	public function num_rows($query) {

		$result = $this->query($query);
		if (!$result) { return false; }
		$r = $result->fetch_assoc();
		
		if (isSet($r['count(*)'])) { return intval($r['count(*)']); }
		else { return 0; }
		
	}
	
	/**
	 * Returns text of last database query.
	 * 
	 * @return String Text of last query run on database.
	 */
	public function get_last_query() {
		return $this->last_query;
	}
	
	/**
	 * Returns data from last database query.
	 * 
	 * @return mysqli_result Result of last query run on database.
	 */
	public function get_last_result() {
		return $this->last_result;
	}
	
	/**
	 * Returns ID of the last row inserted to the database.
	 * 
	 * @return int ID of last inserted row.
	 */
	public function get_last_insert_id() {
		return $this->mysqli->insert_id;
	}

	
	/**
	 * Performs an insert query on the database.
	 * 
	 * @param String $table Table in which data will be inserted.
	 * @param array $items Associative array of data to be inserted, where array keys are colum names.
	 * @param boolean $sanitize If true, will add quotation marks and escape values.
	 * @return boolean|mysqli_result Results of given query. 
	 */
	public function insert($table, $items, $sanitize=true) {

		$query = "INSERT INTO ".$table." (";

		/*foreach ($items as $c=>$v) {
			$query .= $c.", ";
		}
		$query = substr($query, 0, -2); // Remove Final Comma*/
		$query .= implode(', ', array_keys($items));

		$query .= ") VALUES (";
		
		/*foreach ($items as $c=>$v) {
			if ($sanitize) { $v = "'".$this->sn($v)."'"; }
			$query .= $v.", ";
		}
		$query = substr($query, 0, -2); // Remove Final Comma*/
		
		if ($sanitize) {
			foreach ($items as $c=>$v) {
				$items[$c] = "'".$this->sn($v)."'";
			}
		}
		$query .= implode(', ', $items);

		$query .= ");";
		
		return $this->query($query);

	}

	/**
	 * Performs an update query on the database.
	 * 
	 * @param String $table Table in which data will be updated.
	 * @param array $items Associative array of data to be updated, where array keys are colum, names.
	 * @param String $where Clause to append to query.
	 * @param boolean $sanitize If true, will add quotation marks and escape values.
	 * @return boolean|mysqli_result Results of given query.
	 */
	public function update($table, $items, $where=null, $sanitize=true) {

		$query = "UPDATE ".$table." SET ";

		foreach ($items as $c=>$v) {
			if ($sanitize) { $query .= $c."='".$this->sn($v)."', "; }
			else { $query .= $c."=".$v.", "; }
		}
		$query = substr($query, 0, -2); // Remove Final Comma
		
		if ($where) {
			$query .= " WHERE ".$where.";";
		} else {
			$query .= ";";
		}

		return $this->query($query);

	}
	
	/**
	 * Perfoms a delete query on the database.
	 * 
	 * @param String $table Table in which row will be deleted.
	 * @param String $where Clause to append to query.
	 * @param int $limit Number for query limit clause.
	 * @return boolean|mysqli_result Result of given query.
	 */
	public function delete($table, $where=null, $limit=1) {

		$query = "DELETE FROM ".$table." ";
		if ($where) {
			$query .= " WHERE ".$where;
		}
		if ($limit) { $query .= " LIMIT ".$limit; }
		$query .= ";";

		return $this->query($query);
		
	}
	
	/**
	 * Santizes an value using real_escape_string.
	 * 
	 * @param String $value Value to be sanitized.
	 * @return String Sanitized value. 
	 */
	public function sn($value) {
		return $this->mysqli->real_escape_string($value);
	}
	
	/**
	 * Performs a select query on the database.<br />
	 * Data is then put into an associative array based on a column.
	 * 
	 * @param String $query Properly-formatted Mysql query.
	 * @param String $key Column name by which to sort query data.
	 * @param Boolean $single If true, only one item is assigned per key. Otherwise, each key is return as an array.
	 * @return array Query data in associative array. 
	 */
	public function querysort($query,$key,$single=true) {

		$return = array();
		foreach($this->select($query,true) as $r) {

			if ($single) {
				$return[$r[$key]] = $r;
			} else {
				$return[$r[$key]][] = $r;
			}
			

		}
		return $return;

	}
	
	/**
	 * Accessor method for the number of queries performed on the database since page init.
	 * @return int Number of queries
	 */
	public function get_query_count() {
		return $this->query_count;
	}
	
}

$db = new Database();


?>
