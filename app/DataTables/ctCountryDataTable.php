<?php

namespace App\DataTables;

use App\Models\ctCountry;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class ctCountryDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = ctCountry::select([
		'country_id as id',
		'iso_3_alfa',
		'iso_3_num',
		'descr_nl',
		'descr_fr',
		'descr_en',
		'descr_de',
		'pc_mask',
		'is_in_eu',
		'vat_len_min',
		'vat_len_max',
		'vat_example',
		'iban_len',
		'iban_format',
		'iban_example'
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
			'country_id' => ['title' => trans('msg.col_country_id')],
			'iso_3_alfa' => ['title' => trans('msg.col_iso_3_alfa')],
			'iso_3_num' => ['title' => trans('msg.col_iso_3_num')],
			'descr_nl' => ['title' => trans('msg.col_descr_nl')],
			'descr_fr' => ['title' => trans('msg.col_descr_fr')],
			'descr_en' => ['title' => trans('msg.col_descr_en')],
			'descr_de' => ['title' => trans('msg.col_descr_de')],
			'pc_mask' => ['title' => trans('msg.col_pc_mask')],
			'is_in_eu' => ['title' => trans('msg.col_is_in_eu')],
			'vat_len_min' => ['title' => trans('msg.col_vat_len_min')],
			'vat_len_max' => ['title' => trans('msg.col_vat_len_max')],
			'vat_example' => ['title' => trans('msg.col_vat_example')],
			'iban_len' => ['title' => trans('msg.col_iban_len')],
			'iban_format' => ['title' => trans('msg.col_iban_format')],
			'iban_example' => ['title' => trans('msg.col_iban_example')],

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
        return 'ctcountrydatatable_' . time();
    }
}
