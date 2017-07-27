<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 10/07/2017
 * Time: 16:25
 */

namespace App\DataTables\Buttons;


class aflColorEditAltCopyDelete extends baseButton implements buttonsOnRow
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
		$viewOnly = $this->getViewOnly();
		return $engine
//			->addColumn('btn_all', function($obj) use($viewOnly)
//			{
//				return view('templates/buttons/aflColorEditAltCopyDelete', compact('viewOnly', 'obj'));
//			})
			->addColumn('btn_delivery', function($obj) use($viewOnly)
			{
				return '';
			})
			->addColumn('btn_color', function($obj) use($viewOnly)
			{
				return '';
			})

			->addColumn('btn_edit', function($obj) use($viewOnly)
			{
				return '';
			})
			->addColumn('btn_copy', function($obj) use($viewOnly)
			{
				return '';
			})
			->addColumn('btn_alt', function($obj) use($viewOnly)
			{
				return '';
			})
			->addColumn('btn_delete', function($obj) use($viewOnly)
			{
				return '';
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
//			'btn_all' => ['title' => '', 'orderable' => false, 'searchable' => false, 'width' => '7%'],
			'btn_delivery' => ['title' => '', 'orderable' => false, 'searchable' => false, 'width' => '1%', 'render' => 'set_btn_deliver(data,type,full,meta)', 'class' => 'btn_delivery_sel hidden-xs hidden-sm hidden-md'],
			'btn_color' => ['title' => '', 'orderable' => false, 'searchable' => false, 'width' => '1%', 'render' => 'set_btn_color(data,type,full,meta)', 'class' => 'btn_color_sel hidden-xs hidden-sm hidden-md'],
			'btn_edit' => ['title' => '', 'orderable' => false, 'searchable' => false, 'width' => '1%', 'render' => 'set_btn_edit(data,type,full,meta)', 'class' => 'btn_edit_sel'],
			'btn_copy' => ['title' => '', 'orderable' => false, 'searchable' => false, 'width' => '1%', 'render' => 'set_btn_copy(data,type,full,meta)', 'class' => 'btn_copy_sel'],
			'btn_alt' => ['title' => '', 'orderable' => false, 'searchable' => false, 'width' => '1%', 'render' => 'set_btn_alt(data,type,full,meta)', 'class' => 'btn_alt_sel'],
			'btn_delete' => ['title' => '', 'orderable' => false, 'searchable' => false, 'width' => '1%', 'render' => 'set_btn_delete(data,type,full,meta)', 'class' => 'btn_delete_sel'],
		]);
	}
}