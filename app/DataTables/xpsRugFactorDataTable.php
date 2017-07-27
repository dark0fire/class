<?php

namespace App\DataTables;

use App\Models\xpsRugFactor;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class xpsRugFactorDataTable extends baseDataTable
{
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
	{
		$query = xpsRugFactor::select([
			'rug_factor_id as id',
			'rug_factor_id',
			'ctype_id',
			'gram',
			'factor'
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
			'rug_factor_id' => ['title' => trans('msg.col_rug_factor_id')],
			'ctype_id' => ['title' => trans('msg.col_ctype_id')],
			'gram' => ['title' => trans('msg.col_gram')],
			'factor' => ['title' => trans('msg.col_factor')],

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
        return 'xpsrugfactordatatable_' . time();
    }
}
