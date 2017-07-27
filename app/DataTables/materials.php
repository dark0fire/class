<?php

namespace App\DataTables;

use App\material;

use App\property;
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
class materials extends baseDataTable
{

	function __construct(Datatables $datatables, Factory $viewFactory)
	{
		$this->ajaxColumns = [
			'description' => [],
		];
		$properties = property::get()->toArray();
		foreach($properties as $property)
		{
			$this->ajaxColumns[] = [$property['description'] => []];
		}

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
		$query = material::viewProperties();
		return $this->applyScopes($query);
	}
}
