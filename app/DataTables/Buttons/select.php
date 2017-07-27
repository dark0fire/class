<?php
/**
 * Created by PhpStorm.
 * user: Rob Biermann
 * Date: 9-12-2016
 * Time: 18:49
 */

namespace App\DataTables\Buttons;


use Yajra\Datatables\Engines\EloquentEngine;

class select extends baseButton implements buttonsOnRow
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
		$this->doNotEscape = ['btn_select'];
		return $engine
			->addColumn('btn_select', function($obj)
			{
				$btn_delete = "<input type=\"button\" class=\"btn btn_qry\" name=\"btn_select\" value=\"Selecteer\">";
				return $btn_delete;
			});
	}

	/**
	 * Add buttons to the columns array
	 *
	 * @param $columns A reference to an array of column names
	 * @return void Returns by reference
	 */
	function addButtonsToColumnsArray(&$columns)
	{
		$columns = array_merge($columns, [
			'btn_select' => ['title' => trans('msg.btn_select'), 'width' => '1%', 'orderable' => false, 'searchable' => false],
		]);
	}
}