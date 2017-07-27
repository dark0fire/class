<?php
/**
 * Created by PhpStorm.
 * user: Rob Biermann
 * Date: 9-12-2016
 * Time: 18:00
 */

namespace App\DataTables\Buttons;


use Yajra\Datatables\Engines\EloquentEngine;

class expand extends baseButton implements buttonsOnRow
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
		$this->doNotEscape = ['btn_expand'];
		return $engine
			->addColumn('btn_expand', function($obj)
			{
				$btn_edit = '<span class="details-control"></span>';
				return $btn_edit;
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
		$columns = array_merge([
			'btn_expand' => ['title' => '', 'width' => '1%', 'orderable' => false, 'searchable' => false, 'class' => 'details-control js-details-control'],
		], $columns);
	}
}