<?php

namespace App\DataTables;

use App\Library\DataTables\Buttons\expand;
use App\Models\xpsRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class xpsRequestDataTable extends baseDataTable
{
	protected $idAttribute;
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = xpsRequest::where('basket_id', $this->idAttribute)
			->with('xpsRequestAfls', 'xpsRequestColors', 'xpsProdSg')
			->orderBy('alternative_from', 'asc')
			->orderBy('art_id', 'asc')
			->orderBy('request_id', 'asc')
			->select(
				'request_id',
				'descr',
				'ref_customer',
				'quantity_2del',
				'version',
				'price_calc',
				'price',
				'alternative_from',
				'digital',
				'combi_pref',
				'art_id',
				'mis_ord',
				'prod_sg_id',
				'date_time_2del');

        return $this->applyScopes($query);
    }

	/**
	 * @var array, show these columns in the table
	 */
	public $ajaxColumns;

	function setId($id)
	{
		$this->idAttribute = $id;
	}

	function getId()
	{
		return $this->idAttribute;
	}

	public $viewOnly = false;

    function __construct(Datatables $datatables, Factory $viewFactory)
	{

		$this->ajaxColumns = [
			'request_id' => ['title' => trans('msg.col_id'), 'render' => 'set_request_id(data,type,full,meta)', 'width' => '1%'],
			'descr' => ['title' => trans('msg.col_descr'), 'render' => 'combi_txt(data,type,full,meta)', 'width' => '11%'],
			'ref_customer' => ['title' => trans('msg.col_ref_customer'), 'render' => 'set_new_ref(data,type,full,meta)', 'class' => 'dt-left dt_ref_customer', 'width' => '5%'],
			'quantity_2del' => ['title' => trans('msg.col_quantity_2del'), 'render' => 'set_quantity_2del(data,type,full,meta)', 'width' => '3%', 'class' => 'dt-right'],
			'price_calc' => ['title' => trans('msg.col_price_calc'), 'render' => 'set_price_calc(data,type,full,meta, \'euro\')', 'width' => '3%', 'class' => 'dt-right hidden-xs hidden-sm hidden-md'],
			'price' => ['title' => trans('msg.col_price'), 'render' => 'set_price(data,type,full,meta)', 'width' => '1%', 'class' => 'dt-right'],
			'alt' => ['title' => trans('msg.col_alternative'), 'render' => 'set_rdb_alt(data,type,full,meta)', 'width' => '1%', 'class' => 'rdb_alt_sel'],
			'date_time_2del' => ['title' => trans('msg.col_date_time_2del'), 'render' => 'set_new_eed_lev(data,type,full,meta)', 'width' => '2%', 'class' => 'dt-right dt_datetime'],
		];

		parent::__construct($datatables, $viewFactory);
		$this->setButtonsOnRow(new expand());
		$this->setDefaultParameters([
			'bSort' => false,
			'paging' => false,
			'searching' => false,
			'info' => false,
			'responsive' => true,
		]);
	}

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'xpsrequestdatatable_' . time();
    }
}
