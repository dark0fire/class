<?php

namespace App\DataTables;

use App\Models\ctPostOfficeBox;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class ctPostOfficeBoxDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = ctPostOfficeBox::select([
		'id',
		'number',
		'postcode',
		'city',
		'ct_country_id'
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
			'id' => ['title' => trans('msg.col_id')],
			'number' => ['title' => trans('msg.col_number')],
			'postcode' => ['title' => trans('msg.col_postcode')],
			'city' => ['title' => trans('msg.col_city')],
			'ct_country_id' => ['title' => trans('msg.col_ct_country_id')],

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
        return 'ctpostofficeboxdatatable_' . time();
    }
}
