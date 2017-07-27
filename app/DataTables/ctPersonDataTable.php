<?php

namespace App\DataTables;

use App\Models\ctPerson;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class ctPersonDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = ctPerson::select([
		'id',
		'firstname',
		'lastname',
		'initials',
		'insertion',
		'usualname',
		'gender',
		'maidenname',
		'insertion_maidenname',
		'uses_maidenname',
		'dob',
		'ct_communication_id'
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
			'firstname' => ['title' => trans('msg.col_firstname')],
			'lastname' => ['title' => trans('msg.col_lastname')],
			'initials' => ['title' => trans('msg.col_initials')],
			'insertion' => ['title' => trans('msg.col_insertion')],
			'usualname' => ['title' => trans('msg.col_usualname')],
			'gender' => ['title' => trans('msg.col_gender')],
			'maidenname' => ['title' => trans('msg.col_maidenname')],
			'insertion_maidenname' => ['title' => trans('msg.col_insertion_maidenname')],
			'uses_maidenname' => ['title' => trans('msg.col_uses_maidenname')],
			'dob' => ['title' => trans('msg.col_dob')],
			'ct_communication_id' => ['title' => trans('msg.col_ct_communication_id')],

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
        return 'ctpersondatatable_' . time();
    }
}
