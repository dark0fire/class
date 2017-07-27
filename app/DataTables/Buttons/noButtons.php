<?php
/**
 * Created by PhpStorm.
 * user: Rob Biermann
 * Date: 9-12-2016
 * Time: 18:16
 */

namespace App\DataTables\Buttons;


use Yajra\Datatables\Engines\EloquentEngine;

class noButtons extends baseButton implements buttonsOnRow
{

	/**
	 * Add buttons to the Ajax call
	 *
	 * @param EloquentEngine $engine Require an engine to add the buttons to
	 * @return EloquentEngine Return the engine with the buttons attached
	 */
	function addButtonsToAjax($engine)
	{
		return $engine;
	}

	/**
	 * Add buttons to the columns array
	 *
	 * @param $columns A reference to an array of column names
	 * @return void Returns by reference
	 */
	function addButtonsToColumnsArray(&$columns)
	{
	}
}