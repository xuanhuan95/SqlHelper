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
*
*/
class SqlHelper extends \System\Model
{

	/**
	* @var String
	*/
	protected $tablePrimary = '';

	/**
	 * @param string $table
	 */
	public function checkTableNameNotNull($table = '')
	{
		$tableTemp = '';

		// check table name NULL
		// throw Exception
		if ($this->tablePrimary == '' && $table == '') {
			throw new Exception('Require table name!');
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
	 * @param Array $listItem
	 */
	public function addItems( $listItem = array() , $table = '' )
	{
		$tableTemp = $this->checkTableNameNotNull($table);

		foreach ($listItem as $index => $item) {
			$this->db->insert_row($data)->into($tableTemp)->query()
		}
	}

	/**
	 * @param Array  		$data
	 * @param Array,String  $condition 'id = abc' or array( array('key'=>key,'operator'=>operator,'value'=>value) )
	 * @param String 		$table
	 */
	public function update( $data = array(), $condition = '', $table = '')
	{
		$tableTemp = $this->checkTableNameNotNull($table);


		$result = $this->db->update($data)->from($tableTemp);

		if ( !is_array($condition) ) {
			$result->where($condition);
		}else{

			foreach ($condition as $key => $con) {
				$result->where($con['key'], $con['operator'], $con['value']);
			}

		}
		$result->query();
		return $result;
	}

	public function delete($value = '', $condition = '',$table = '')
	{
		# code...
	}

	public function getItem($value='', $condition = '')
	{
		# code...
	}

	public function getItems($value='', $condition = '')
	{
		# code...
	}

	public function formatData($value = '', $condition = '')
	{
		# code...
	}


}