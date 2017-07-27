<?php

namespace App\DataTables;

use App\Models\ctLockStatus;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class ctLockStatusDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = ctLockStatus::select([
		'id',
		'sequence',
		'descr',
		'translation_key_id'
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
			'sequence' => ['title' => trans('msg.col_sequence'), 'class' => 'reorderSeq'],
			'descr' => ['title' => trans('msg.col_descr')],
			'translation_key_id' => ['title' => trans('msg.col_translation_key_id')],

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
        return 'ctlockstatusdatatable_' . time();
    }
}
