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
	protected $table = '';

	public function insert($data='')
	{
		if( $this->db->insert_row($data)->into($this->table)->query() ){

		 	return $this->db->last_insert_id();

		}

		return false;
	}

	public function update($data = '', $condition = '')
	{

	}

	public function delete($value = '', $condition = '')
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