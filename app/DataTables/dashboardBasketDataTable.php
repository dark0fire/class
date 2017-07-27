<?php

namespace App\DataTables;

use App\Models\xpsBasket;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\View\Factory;

/**
 * Class dashboardBasketDataTable
 *
 * datatable to use on the dashboard for the basket data.
 *
 *
 * @package App\DataTables
 */
class dashboardBasketDataTable extends baseDataTable
{

    /**
     * userDataTable constructor.
     * @param Datatables $datatables
     * @param Factory $viewFactory
     */
    function __construct(Datatables $datatables, Factory $viewFactory)
    {
        $this->ajaxColumns = [
            'basket_id' => ['title' => trans('msg.col_basket_id'), 'width' => '10%', 'orderable' => true],
			'user_name' => ['title' => trans('msg.col_username'), 'width' => '10%', 'orderable' => true, 'name' => 'users.name', 'data' => 'user_name'],
            'basket_status_descr' => ['title' => trans('msg.col_basket_status_descr'), 'width' => '5%', 'name' => 'xps_basket_status.descr_nl', 'data' => 'basket_status_descr'],
			'mis_klt_naam' => ['title' => trans('msg.col_customer_name'), 'width' => '5%', 'name' => 'xps_klt_qry.naam', 'data' => 'mis_klt_naam'],
            'basket_descr' => ['title' => trans('msg.col_basket_descr'), 'width' => '5%', 'name' => 'xps_basket.basket_descr', 'data' => 'basket_descr'],
            'request_date' => ['title' => trans('msg.col_created_at'), 'width' => '8%', 'name' => 'xps_basket.timestamp_create', 'data' => 'request_date', 'render' => 'renderDate(data,type,full,meta)'],
        ];
		$this->searchableColumns = [
			'mis_klt_naam',
			'basket_status_descr',
			'user_name',
			'basket_id',
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
		$query = xpsBasket::select(
			'xps_basket.basket_id as id',
			'xps_basket_status.descr_nl AS basket_status_descr',
			'xps_basket.basket_id',
//			'xps_basket.user_id',
			'users.name AS user_name',
			'xps_klt_qry.naam AS mis_klt_naam',
			'xps_basket.basket_descr AS basket_descr',
			'xps_basket.timestamp_create AS request_date')
		->where('xps_basket.basket_status_id', '<', 4)
		->leftJoin('xps_basket_status', 'xps_basket_status.basket_status_id', '=', 'xps_basket.basket_status_id')
		->leftJoin('users', 'xps_basket.user_id', '=', 'users.id')
		->leftJoin('xps_klt_qry', 'xps_basket.mis_klt', '=', 'xps_klt_qry.klt');

		return $this->applyScopes($query);
	}





}
