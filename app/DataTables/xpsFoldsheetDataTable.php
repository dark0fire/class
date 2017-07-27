<?php

namespace App\DataTables;

use App\Models\xpsFoldsheet;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class xpsFoldsheetDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = xpsFoldsheet::select([
		'foldsheet_id as id',
		'foldsheet_id',
		'foldcat',
		'stand',
		'pag',
		'strook',
		'descr',
		'pag_in_breedte',
		'pag_in_hoogte',
		'afloop_l',
		'afloop_r',
		'afloop_b',
		'afloop_o',
		'kopwit_breed',
		'kopwit_hoog',
		'kruiswit_breed',
		'kruiswit_hoog',
		'freeswit_breed',
		'freeswit_hoog',
		'overslag_breed',
		'overslag_hoog'
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
			'foldsheet_id' => ['title' => trans('msg.col_foldsheet_id')],
			'foldcat' => ['title' => trans('msg.col_foldcat')],
			'stand' => ['title' => trans('msg.col_stand')],
			'pag' => ['title' => trans('msg.col_pag')],
			'strook' => ['title' => trans('msg.col_strook')],
			'descr' => ['title' => trans('msg.col_descr')],
			'pag_in_breedte' => ['title' => trans('msg.col_pag_in_breedte')],
			'pag_in_hoogte' => ['title' => trans('msg.col_pag_in_hoogte')],
			'afloop_l' => ['title' => trans('msg.col_afloop_l')],
			'afloop_r' => ['title' => trans('msg.col_afloop_r')],
			'afloop_b' => ['title' => trans('msg.col_afloop_b')],
			'afloop_o' => ['title' => trans('msg.col_afloop_o')],
			'kopwit_breed' => ['title' => trans('msg.col_kopwit_breed')],
			'kopwit_hoog' => ['title' => trans('msg.col_kopwit_hoog')],
			'kruiswit_breed' => ['title' => trans('msg.col_kruiswit_breed')],
			'kruiswit_hoog' => ['title' => trans('msg.col_kruiswit_hoog')],
			'freeswit_breed' => ['title' => trans('msg.col_freeswit_breed')],
			'freeswit_hoog' => ['title' => trans('msg.col_freeswit_hoog')],
			'overslag_breed' => ['title' => trans('msg.col_overslag_breed')],
			'overslag_hoog' => ['title' => trans('msg.col_overslag_hoog')],

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
        return 'xpsfoldsheetdatatable_' . time();
    }
}
