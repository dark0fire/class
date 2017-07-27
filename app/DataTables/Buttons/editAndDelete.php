<?php
/**
 * Created by PhpStorm.
 * user: Rob Biermann
 * Date: 9-12-2016
 * Time: 18:00
 */

namespace App\DataTables\Buttons;


use Yajra\Datatables\Engines\EloquentEngine;

class editAndDelete extends baseButton implements buttonsOnRow
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
		$this->doNotEscape = ['btn_edit','btn_delete'];
		return $engine
			->addColumn('btn_edit', function($obj)
			{
				$btn_edit = '<button class="edit btn btn-sm btn-primary btn-dt btn_edit" title="Edit ' . $obj->name . '" name="' . $obj->id . '"><span class="glyphicon fa fa-lg icon_btn_edit" aria-hidden="true"></span></button>';
				return $btn_edit;
			})
			->addColumn('btn_delete', function($obj)
			{
				$btn_delete = '<button class="delete btn btn-sm btn-danger btn-dt btn_delete" title="Delete ' . $obj->name . '" name="' . $obj->id . '"><span class="glyphicon fa fa-lg icon_btn_delete" aria-hidden="true"></span></button>';
				return $btn_delete;
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
			'btn_edit' => ['title' => '', 'width' => '1%', 'orderable' => false, 'searchable' => false],
			'btn_delete' => ['title' => '', 'width' => '1%', 'orderable' => false, 'searchable' => false],
		]);
	}
}