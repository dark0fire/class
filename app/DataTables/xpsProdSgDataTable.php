<?php

namespace App\DataTables;

use App\Models\xpsProdSg;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class xpsProdSgDataTable extends baseDataTable
{
	private $ctLockStatus;

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = xpsProdSg::join('sys_lock_status', 'xps_prod_sg.sys_lock_status_id', '=', 'sys_lock_status.sys_lock_status_id')
			->join('xps_prod_hg', 'xps_prod_sg.prod_hg_id', '=', 'xps_prod_hg.prod_hg_id')
			->join('sys_ctype', 'xps_prod_sg.sys_ctype_id', '=', 'sys_ctype.ctype_id')
			->join('sys_ptype', 'xps_prod_sg.sys_ptype_id', '=', 'sys_ptype.ptype_id')
			->select([
				'prod_sg_id as id',
				'prod_sg_id',
				'xps_prod_sg.prod_hg_id as prod_hg_id',
				'xps_prod_hg.descr_int as hg_descr',
				'xps_prod_sg.class',
				'xps_prod_sg.seq',
				'sys_ctype_id',
				'sys_ctype.descr_nl as sys_ctype_descr',
				'sys_ptype_id',
				'sys_ptype.descr_nl as sys_ptype_descr',
				'sys_ptype_id_digital',
				'xps_prod_sg.descr_int',
				'xps_prod_sg.descr_nl',
				'xps_prod_sg.descr_fr',
				'xps_prod_sg.descr_en',
				'xps_prod_sg.descr_de',
				'mis_prodw_digital',
				'xps_prod_sg.tt_nl',
				'xps_prod_sg.tt_fr',
				'xps_prod_sg.tt_en',
				'xps_prod_sg.tt_de',
				'xps_prod_sg.help_ref',
				'xps_prod_sg.sys_lock_status_id',
				'sys_lock_status.descr as status_descr',
				'var_quantity',
				'mis_prodw',
				'xps_prod_sg.mis_klt',
				'no_combi',
				'versies',
				'article',
				'digital'
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
			'dummy' => ['title' => '', 'width' => '1%', 'orderable' => false, 'searchable' => false, 'defaultContent' => '', 'class' => 'details-control'],
			'prod_hg_id' => ['title' => trans('msg.col_prod_hg_id'), 'visible' => false],
			'hg_descr' => ['title' => trans('msg.mdl_xps_prod_hg')],
			'prod_sg_id' => ['title' => trans('msg.col_prod_sg_id')],
			'class' => ['title' => trans('msg.col_class'), 'visible' => false],
			'sys_ctype_id' => ['title' => trans('msg.col_sys_ctype_id'), 'visible' => false],
			'sys_ptype_id' => ['title' => trans('msg.col_sys_ptype_id'), 'visible' => false],
			'sys_ptype_id_digital' => ['title' => trans('msg.col_sys_ptype_id_digital'), 'visible' => false],
			'descr_int' => ['title' => trans('msg.col_descr_int')],
			'descr_nl' => ['title' => trans('msg.col_descr_nl'), 'visible' => false],
			'descr_fr' => ['title' => trans('msg.col_descr_fr'), 'visible' => false],
			'descr_en' => ['title' => trans('msg.col_descr_en'), 'visible' => false],
			'descr_de' => ['title' => trans('msg.col_descr_de'), 'visible' => false],
			'mis_prodw_digital' => ['title' => trans('msg.col_mis_prodw_digital'), 'visible' => false],
			'tt_nl' => ['title' => trans('msg.col_tt_nl'), 'visible' => false],
			'tt_fr' => ['title' => trans('msg.col_tt_fr'), 'visible' => false],
			'tt_en' => ['title' => trans('msg.col_tt_en'), 'visible' => false],
			'tt_de' => ['title' => trans('msg.col_tt_de'), 'visible' => false],
			'help_ref' => ['title' => trans('msg.col_help_ref'), 'visible' => false],
			'var_quantity' => ['title' => trans('msg.col_var_quantity'), 'visible' => false],
			'mis_prodw' => ['title' => trans('msg.col_mis_prodw'), 'visible' => false],
			'mis_klt' => ['title' => trans('msg.col_mis_klt'), 'visible' => false],
			'no_combi' => ['title' => trans('msg.col_no_combi'), "render" => "renderBool(data, type, full, meta)"],
			'versies' => ['title' => trans('msg.col_versies'), "render" => "renderBool(data, type, full, meta)"],
			'article' => ['title' => trans('msg.col_article'), "render" => "renderBool(data, type, full, meta)"],
			'digital' => ['title' => trans('msg.col_digital'), "render" => "renderBool(data, type, full, meta)"],
			'sys_lock_status_id' => ['title' => trans('msg.col_sys_lock_status_id'), 'visible' => false],
			'status_descr' => ['title' => trans('msg.col_sys_lock_status_id')],

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
        return 'xpsprodsgdatatable_' . time();
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
