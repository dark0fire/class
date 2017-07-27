<?php

namespace App\DataTables;

use App\Models\xpsArt;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class xpsArtDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = xpsArt::join('sys_lock_status', 'xps_art.sys_lock_status_id', '=', 'sys_lock_status.sys_lock_status_id')
		->select([
			'art_id',
			'art_id as id',
			'prod_sg_id',
			'xps_art.descr',
			'mis_art',
			'env_id',
			'xps_art.sys_lock_status_id',
			'sys_lock_status.descr as lock_descr',
			'digital',
			'price_only'
        ]);

        return $this->applyScopes($query);
    }

	/**
	 * @var array, show these columns in the table
	 */
	public $ajaxColumns;

    function __construct(Datatables $datatables, Factory $viewFactory)
	{

		$this->ajaxColumns = [
			'art_id' => ['title' => trans('msg.col_art_id')],
			'dummy' => ['title' => '', 'width' => '1%', 'orderable' => false, 'searchable' => false, 'defaultContent' => '', 'class' => 'details-control'],
			'prod_sg_id' => ['title' => trans('msg.col_prod_sg_id')],
			'descr' => ['title' => trans('msg.col_descr')],
			'mis_art' => ['title' => trans('msg.col_mis_art')],
			'env_id' => ['title' => trans('msg.col_env_id')],
			'sys_lock_status_id' => ['title' => trans('msg.col_sys_lock_status_id'), 'visible' => false],
			'lock_descr' => ['title' => trans('msg.col_sys_lock_status_id')],
			'digital' => ['title' => trans('msg.col_digital'), 'render' => 'renderBoolean(data)'],
			'price_only' => ['title' => trans('msg.col_price_only'), 'render' => 'renderBoolean(data)'],

		];
		parent::__construct($datatables, $viewFactory);
	}

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'xpsartdatatable_' . time();
    }
}
