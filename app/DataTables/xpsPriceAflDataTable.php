<?php

namespace App\DataTables;

use App\Models\xpsPriceAfl;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class xpsPriceAflDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = xpsPriceAfl::select([
		'xps_price_afl_id as id',
		'kilo',
		'address',
		'price'
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
			'id' => ['title' => trans('msg.col_xps_price_afl_id')],
			'kilo' => ['title' => trans('msg.col_kilo'), 'className' => 'dt-right', 'render' => 'generalRender(data, type, full, meta,"weight", "")'],
			'address' => ['title' => trans('msg.col_address')],
			'price' => ['title' => trans('msg.col_price'), 'className' => 'dt-right', 'render' => 'generalRender(data, type, full, meta,"euro", "")'],

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
        return 'xpspriceafldatatable_' . time();
    }
}
