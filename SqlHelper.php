<?php
/*
 * +------------------------------------------------------------------------+
 * | MaskPHP - A PHP Framework For Beginners                                |
 * | Authors        : Mask PHP                                              |
 * | E-mail         : support@maskphp.com                                   |
 * | Website        : http://maskphp.com                                    |
 * | PHP version    : >= 5.3.0                                              |
 * +------------------------------------------------------------------------+
 * | Copyrights(C) 2015 by MASK PHP                                         |
 * | All rights reserved                                                    |
 * +------------------------------------------------------------------------+
 */

namespace Library;

/**
* Simple Class Support Sql query for MaskPHP Frame work
*/
class SqlHelper extends \System\Model
{

	/**
	* @var String
	*/
	public $tablePrimary = '';

	/**
	 * @param string $table
	 */
	private function checkTableNameNotNull($table = '')
	{
		$tableTemp = '';

		// check table name NULL
		// throw Exception
		if ($this->tablePrimary == '' && $table == '') {
			throw new \Exception('Require table name!');
		}

		// set value for var tableTemp
		if ( $table != '' ) {
			$tableTemp = $table;
		}else{
			$tableTemp = $this->tablePrimary;
		}

		return $tableTemp;
	}

	/**
	 * @param Object 		$obj
	 * @param Array,String  $condition
	 */
	private function checkCondition( $obj = '', $condition = '')
	{
		if ( !is_object($obj) ) {
			throw new \Exception('Type of first param must be Object!');
		}

		if ( is_string($condition) ) {
			$obj = $obj->where($condition);
		}else{

			foreach ($condition as $key => $con) {
				$obj = $obj->where($con['key'], $con['operator'], $con['value']);
			}
		}

		return $obj;
	}

	/**
	* @param Array  $data
	* @param String $table
	*/
	public function addItem($data = array(), $table = '')
	{
		$tableTemp = $this->checkTableNameNotNull($table);

		if( $this->db->insert_row($data)->into($tableTemp)->query() ){

		 	return $this->db->last_insert_id();

		}

		return false;
	}

	/**
	 * @param Array  $listItem
	 * @param String $table
	 */
	public function addItems( $listItem = array() , $table = '' )
	{
		$tableTemp = $this->checkTableNameNotNull($table);

		foreach ($listItem as $index => $item) {

			$this->db->insert_row($item)->into($tableTemp)->query();

		}

		return true;
	}

	/**
	 * @param Array  		$data
	 * @param Array,String  $condition 'id = abc' or array( array('key'=>key,'operator'=>operator,'value'=>value) )
	 * @param String 		$table
	 */
	public function updateItem( $data = array(), $condition = '', $table = '')
	{
		$tableTemp = $this->checkTableNameNotNull($table);

		$result = $this->db->update($data)->from($tableTemp);

		$result = $this->checkCondition($result,$condition);

		$result = $result->query();

		return $result;
	}

	/**
	 * @param Array,String $condition
	 * @param String 	   $table
	 */
	public function deleteItem($condition = '',$table = '')
	{
		$tableTemp = $this->checkTableNameNotNull($table);

		$result = $this->db->delete()->from($tableTemp);

		$result = $this->checkCondition($result,$condition);

		$result = $result->query();

		return $result;

	}

	/**
	 * @param Array,String  $condition
	 * @param String 		$table
	 * @param String 		$field  Example: 'name,address' or NULL
	 */
	public function getItem($condition = '', $table = '',$field = '')
	{
		$tableTemp = $this->checkTableNameNotNull($table);

		if ($field) {

			$item = $this->db->select($field);

		}else{

			$item = $this->db->select();

		}

		$item = $item->from($tableTemp);

		$item = $this->checkCondition($item,$condition);

		$item = $item->fetch_row();

		return $item;
	}

	//asc desc
	/**
	 * @param Array,String  $condition
	 * @param String 		$table
	 * @param String 		$field  Example: 'name,address' or NULL
	 * @param Array         $sort = array( 'field'=> ,'type'=> ); true: DESC, false : ASC
	 * @param Int           $offset
	 * @param Int           $limit
	 */
	public function getItems( $condition = '', $table = '', $field = '', $sort = array(), $offset = 0,$limit = 50 )
	{
		$tableTemp = $this->checkTableNameNotNull($table);

		if ($field) {

			$items = $this->db->select($field);

		}else{

			$items = $this->db->select();

		}

		$items = $items->from($tableTemp);

		$items = $this->checkCondition($items,$condition);

		if ( is_array($sort) ) {

			if ( !array_key_exists('field',$sort) ) {
				throw new Exception("Array require field key and value not NULL");
			}

			$sortType = isset($sort['type']) ? $sort['type'] : false;

			$items = $items->order_by($sort['field'],$sortType);
		}

		$items = $items->limit($limit,$offset)->fetch();

		return $items;
	}

	/**
	 * @param Array $data
	 * @param Array $format
	 */
	public function formatData( $data = array(), $format = array() )
	{
		# code...
	}


}

