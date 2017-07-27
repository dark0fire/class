<?php
/**
 * Created by PhpStorm.
 * user: Rob Biermann
 * Date: 9-12-2016
 * Time: 18:00
 */

namespace App\DataTables\Buttons;


use Yajra\Datatables\Engines\EloquentEngine;

class viewOrderAdd extends baseButton implements buttonsOnRow
{

	public $doNotEscape;
	/**
	 * Add buttons to the Ajax call
	 *
	 * @param EloquentEngine $engine Require an engine to add the buttons to
	 * @return EloquentEngine Return the engine with the buttons attached
	 */
	function addButtonsToAjax($engine)
	{
		$this->doNotEscape = ['btn_all'];
//		$this->doNotEscape = ['btn_view', 'btn_order', 'btn_add'];
		return $engine
			->addColumn('btn_all', function($obj)
			{
				return view('templates/buttons/viewOrderAdd');
			});
	}

	/**
	 * Add buttons to the columns array
	 *
	 * @param $columns A reference to an array of column names
	 * @return void Returns by reference
	 */
	function addButtonsToColumnsArray(&$columns = [])
	{
		$columns = array_merge($columns, [
			'btn_all' => ['title' => '', 'width' => '8%', 'orderable' => false, 'searchable' => false],
		]);
	}
}