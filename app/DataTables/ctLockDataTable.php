<?php

namespace App\DataTables;

use App\Models\ctLock;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class ctLockDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = ctLock::select([
		'id',
		'ct_lock_status_id',
		'sequence',
		'descr',
		'locked_at',
		'locked_by'
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
			'ct_lock_status_id' => ['title' => trans('msg.col_ct_lock_status_id')],
			'sequence' => ['title' => trans('msg.col_sequence'), 'class' => 'reorderSeq'],
			'descr' => ['title' => trans('msg.col_descr')],
			'locked_at' => ['title' => trans('msg.col_locked_at')],
			'locked_by' => ['title' => trans('msg.col_locked_by')],

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
        return 'ctlockdatatable_' . time();
    }
}
