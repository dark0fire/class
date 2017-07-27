<?php

namespace App\DataTables;

use App\Models\ctCommunicationSocialMedia;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class ctCommunicationSocialMediaDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = ctCommunicationSocialMedia::select([
		'ct_communication_id as id',
		'ct_communication_id',
		'social_medium_id',
		'url'
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
			'ct_communication_id' => ['title' => trans('msg.col_ct_communication_id')],
			'social_medium_id' => ['title' => trans('msg.col_social_medium_id')],
			'url' => ['title' => trans('msg.col_url')],

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
        return 'ctcommunicationsocialmediadatatable_' . time();
    }
}
