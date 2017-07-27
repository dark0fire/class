<?php

namespace App\DataTables;

use App\Models\socialMedia;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class socialMediaDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = socialMedia::select([
		'id as id',
		'id',
		'name'
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
			'name' => ['title' => trans('msg.col_name')],

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
        return 'socialmediadatatable_' . time();
    }
}
