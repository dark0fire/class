<?php

namespace App\DataTables;

use App\Models\xpsPara;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class xpsParaDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = xpsPara::select([
		'xps_para_id as id',
		'xps_para_id',
		'xps_para_key',
		'descr',
		'val'
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
			'xps_para_id' => ['title' => trans('msg.col_xps_para_id')],
			'xps_para_key' => ['title' => trans('msg.col_xps_para_key')],
			'descr' => ['title' => trans('msg.col_descr')],
			'val' => ['title' => trans('msg.col_val')],

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
        return 'xpsparadatatable_' . time();
    }
}
