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
		$this->_query;

	}

	public function insert( $tableName, $insertData ) {

	}

	public function update( $tableName, $tableData ) {

	}

	public function delete( $tableName ) {

	}

	public function where( $whereProp, $whereValue ) {

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
		} else {
			return $stmt;
		}
	}

	public function __destruct() {

	}

}