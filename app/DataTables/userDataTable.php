<?php

namespace App\DataTables;


use Illuminate\Support\Facades\DB;
use Illuminate\View\Factory;
use Yajra\Datatables\Datatables;

class userDataTable extends baseDataTable
{
    /**
     * userDataTable constructor.
     * @param Datatables $datatables
     * @param Factory $viewFactory
     */
	function __construct(Datatables $datatables, Factory $viewFactory)
	{

		$this->ajaxColumns = [
			'id' => ['title' => trans('msg.col_id'), 'name' => 'users.id', 'data' => 'id'],
			'name' => ['title' => trans('msg.col_name'), 'name' => 'name', 'data' => 'name'],
			'email' => ['title' => trans('msg.col_email'), 'name' => 'users.email', 'data' => 'email'],
			'bu' => ['title' => trans('msg.col_bu'), 'name' => 'sys_bu.descr', 'data' => 'bu'],
		];
//		$this->searchableColumns = [
//			'id',
//			'name',
//			'email',
//			'bu',
//		];
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
         * Build the required query
         */
        $main_query = DB::table('users')
            ->join('sys_bu', 'users.sys_bu_id', '=', 'sys_bu.id')
            ->select([
                'users.id as id',
                'users.id',
                'name',
                'users.email',
                'sys_bu.descr as bu'
            ]);
        return $this->applyScopes($main_query);
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'userdatatables_' . time();
    }
}
