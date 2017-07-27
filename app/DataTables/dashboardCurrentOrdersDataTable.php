<?php

namespace App\DataTables;

use App\Models\xpsBasket;
use App\Models\xpsRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

/**
 * Class dashboardBasketDataTable
 *
 * datatable to use on the dashboard for the basket data.
 *
 *
 * @package App\DataTables
 */
class dashboardCurrentOrdersDataTable extends baseDataTable
{

	function __construct(Datatables $datatables, Factory $viewFactory)
	{
		$this->ajaxColumns = [
			'request_id' => ['title' => trans('msg.col_request_id'), 'width' => '10%', 'orderable' => true, 'class' => 'classname'],
			'customer_name' => ['title' => trans('msg.col_customer_name'), 'width' => '10%', 'orderable' => true],
			'customer_code' => ['title' => trans('msg.col_customer_code'), 'width' => '10%', 'orderable' => true],
			'mis_ord' => ['title' => trans('msg.col_order_number'), 'width' => '10%', 'orderable' => true],
			'description' => ['title' => trans('msg.col_descr'), 'width' => '10%', 'orderable' => false],
			'quantity' => ['title' => trans('msg.col_quantity'), 'width' => '10%', 'orderable' => true, 'class' => 'dt-right dt_datetime'],
			'price' => ['title' => trans('msg.col_price'), 'width' => '10%', 'orderable' => false, 'class' => 'dt-right dt_datetime'],
			'delivery_date' => ['title' => trans('msg.col_delivery_date'), 'width' => '10%', 'orderable' => true, 'render' => 'renderDate(data,type,full,meta)'],
		];
		$this->searchableColumns = [
			'request_id',
			'customer_name'
		];
		parent::__construct($datatables, $viewFactory);
	}

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        /**
         * Create your query
		 */
		$query = xpsRequest::select(
			'xps_request.request_id as id',
			'xps_request.request_id',
			'xps_request.mis_ord',
//			'users.name AS user_name',
			'xps_basket.mis_klt AS customer_code',
			'xps_klt_qry.naam AS customer_name',
			'xps_request.quantity_2del AS quantity',
			'xps_request.descr AS description',
			'xps_request.price',
			'xps_request.date_time_2del AS delivery_date')
			->whereNotNull('mis_ord')
			->leftJoin('users', 'xps_request.user_id', '=', 'users.id')
			->leftJoin('xps_basket', 'xps_request.basket_id', '=', 'xps_basket.basket_id')
			->leftJoin('xps_klt_qry', 'xps_basket.mis_klt', '=', 'xps_klt_qry.klt');

		return $this->applyScopes($query);
	}
}
