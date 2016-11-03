<?php

/**
 * Created by PhpStorm.
 * User: LordBic
 * Date: 02/11/2016
 * Time: 21:14
 */
class MySqlDb {
	//  Create protected property since only method in class and any possible
	//  child class will need to access it
	protected $_mysqli;
	protected $_query;
	protected $_where = array();
	protected $_paramTypeList;

	//Constructor
	public function __construct( $host, $username, $password, $db ) {
		$this->_mysqli = new mysqli( $host, $username, $password, $db ) or die( 'Error connecting to database' );
	}

	public function query( $query ) {
		$this->_query = filter_var( $query, FILTER_SANITIZE_STRING );
		$stmt         = $this->_prepareQuery();
		$stmt->execute();
		$results = $this->_dynamicBindResults( $stmt );

		return $results;

	}

	public function get( $tableName, $numRows = null ) {
		$this->_query = "SELECT * FROM $tableName";
		$stmt         = $this->_buildQuery( $numRows );
		$stmt->execute();
		$results = $this->_dynamicBindResults( $stmt );

		return $results;
	}

	public function insert( $tableName, $insertData ) {
		$this->_query = "INSERT into $tableName";
		$stmt = $this->_buildQuery(NULL, $insertData);
		$stmt->execute();
		if($stmt->affected_rows){
			return true;
		}

	}

	public function update($tableName, $tableData)
	{
		$this->_query = "UPDATE $tableName SET ";

		$stmt = $this->_buildQuery(NULL, $tableData);
		$stmt->execute();

		if ($stmt->affected_rows)
			return true;
	}

	public function delete($tableName) {
		$this->_query = "DELETE FROM $tableName";

		$stmt = $this->_buildQuery();
		$stmt->execute();

		if ($stmt->affected_rows)
			return true;
	}

	public function where( $whereProp, $whereValue ) {
		$this->_where[ $whereProp ] = $whereValue;

	}

	protected function _buildQuery( $numRows = null, $tableData = false ) {
		$hasTableData = null;
		//if a tableData was passed in as part of the build query then check if it
		// of type array
		if ( gettype( $tableData ) === 'array' ) {
			$hasTableData = true;
		}

		//Did user call where
		if ( ! empty( $this->_where ) ) {
			$keys        = array_keys( $this->_where );
			$where_prop  = $keys[0];
			$where_value = $this->_where[ $where_prop ];

			if ( $hasTableData ) {
				// Loop through array and get key => value pair
				foreach ( $tableData as $prop => $value ) {
					//loop
				}
			} else {
				$this->_paramTypeList = $this->_determineType( $where_value );
				$this->_query .= " WHERE " . $where_prop . "= ?";
			}
		}
		if ( isset( $numRows ) ) {
			$this->_query .= " LIMIT " . (int) $numRows;
		}
		// We now prepare query
		$stmt = $this->_prepareQuery();

		if ( $this->_where ) {
			$stmt->bind_param( $this->_paramTypeList, $where_value );
		}
		return $stmt;

	}


	protected function _determineType( $item ) {
		$param_type = '';
		switch ( gettype( $item ) ) {
			case 'string' :
				$param_type = 's';
				break;
			case 'integer' :
				$param_type = 'i';
				break;
			case 'blob' :
				$param_type = 'b';
				break;
			case 'double' :
				$param_type = 'd';
				break;
		}
		return $param_type;
	}

	protected function _dynamicBindResults( $stmt ) {
		$parameters = array();
		$results    = array();
		$meta       = $stmt->result_metadata();
		while ( $field = $meta->fetch_field() ) {
			$parameters[] = &$row[ $field->name ];
		}
		call_user_func_array( array( $stmt, 'bind_result' ), $parameters );
		while ( $stmt->fetch() ) {
			//echo "<pre>",print_r($row),"</pre>";
			$x = array();
			foreach ( $row as $key => $val ) {
				//echo "The key is : ". $key . " and the value is :".$val ."<br>";
				$x[ $key ] = $val;
			}
			$results[] = $x;
		}
		return $results;
	}

	protected function _prepareQuery() {
		if ( ! $stmt = $this->_mysqli->prepare( $this->_query ) ) {
			trigger_error( 'Problem preparing query', E_USER_ERROR );
		}
			return $stmt;
	}

	public function __destruct() {
		$this->_mysqli->close();
	}

}