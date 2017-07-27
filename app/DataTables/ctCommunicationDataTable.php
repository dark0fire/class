<?php

namespace App\DataTables;

use App\Models\ctCommunication;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class ctCommunicationDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = ctCommunication::select([
		'id',
		'phone',
		'mobile',
		'email',
		'website'
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
			'phone' => ['title' => trans('msg.col_phone')],
			'mobile' => ['title' => trans('msg.col_mobile')],
			'email' => ['title' => trans('msg.col_email')],
			'website' => ['title' => trans('msg.col_website')],

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
        return 'ctcommunicationdatatable_' . time();
    }
}
