<?php

namespace App\DataTables;

use App\Models\xpsProdHg;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class xpsProdHgDataTable extends baseDataTable
{
	private $ctLockStatus;

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = xpsProdHg::select([
		'prod_hg_id',
		'prod_hg_id as id',
		'class',
		'seq',
		'descr_int',
		'descr_nl',
		'descr_fr',
		'descr_en',
		'descr_de',
		'tt_nl',
		'tt_fr',
		'tt_en',
		'tt_de',
		'help_ref',
		'sys_lock_status_id',
		'mis_klt'
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
			'seq' => ['title' => trans('msg.col_seq'), 'class' => 'reorderSeq'],
			'prod_hg_id' => ['title' => trans('msg.col_prod_hg_id')],
			'class' => ['title' => trans('msg.col_class')],
			'descr_int' => ['title' => trans('msg.col_descr_int')],
			'descr_nl' => ['title' => trans('msg.col_descr_nl'), 'visible' => false],
			'descr_fr' => ['title' => trans('msg.col_descr_fr'), 'visible' => false],
			'descr_en' => ['title' => trans('msg.col_descr_en'), 'visible' => false],
			'descr_de' => ['title' => trans('msg.col_descr_de'), 'visible' => false],
			'tt_nl' => ['title' => trans('msg.col_tt_nl'), 'visible' => false],
			'tt_fr' => ['title' => trans('msg.col_tt_fr'), 'visible' => false],
			'tt_en' => ['title' => trans('msg.col_tt_en'), 'visible' => false],
			'tt_de' => ['title' => trans('msg.col_tt_de'), 'visible' => false],
			'help_ref' => ['title' => trans('msg.col_help_ref'), 'visible' => false],
			'sys_lock_status_id' => ['title' => trans('msg.col_sys_lock_status_id'), 'visible' => false],
			'mis_klt' => ['title' => trans('msg.col_mis_klt'), 'visible' => false],

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
        return 'xpsprodhgdatatable_' . time();
    }


	/**
	 * Sets ct_lock_status data for datatable.
	 *
	 * @param $ctLockStatus
	 */
	public function setCtLockStatus($ctLockStatus)
	{
    	$this->ctLockStatus = $ctLockStatus;
	}
}
