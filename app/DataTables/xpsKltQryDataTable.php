<?php

namespace App\DataTables;

use App\Models\user;
use App\Models\xpsKltQry;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class xpsKltQryDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $user = user::getSession();
        $query = xpsKltQry::select([
			'klt as id',
			'klt',
			'naam',
			'adres',
			'pc',
			'wpl',
			'stawinpct', //This data will not be viewed in datatable, but will be used when selection is done
			'order_ok', //This data will not be viewed in datatable, but will be used when selection is done
            'unitcode',
            'kvk',
        ])->where ('unitcode',$user->sysBu->mis_id)
          ->where ('unitcode','<>','')
          ->orderBy('klt', 'asc');

        return $this->applyScopes($query);
    }

	/**
	 * @var array, show these columns in the table
	 */
	public $ajaxColumns;

    function __construct(Datatables $datatables, Factory $viewFactory)
	{

		$this->ajaxColumns = [
			'klt' => ['title' => trans('msg.col_klt'), "class" => "klt"],
			'naam' => ['title' => trans('msg.col_naam'), "class" => "naam"],
			'adres' => ['title' => trans('msg.col_adres'), "class" => "adres"],
			'pc' => ['title' => trans('msg.col_pc'), "class" => "pc"],
			'wpl' => ['title' => trans('msg.col_wpl'), "class" => "wpl"],
            'unitcode' => ['title' => trans('msg.col_unitcode'), "class" => "unitcode"],
            'kvk' => ['title' => trans('msg.col_kvk'), "class" => "kvk"],
		];
		$this->setAjaxUrl(asset('customer/selection'));
		parent::__construct($datatables, $viewFactory);
	}

    /**
     * Get default builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'order' => [0, 'asc']
        ];
    }




    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'xpskltqrydatatable_' . time();
    }

//	public function html()
//	{
//		/**
//		 * Use addButtonsToColumnsArray in the middle to allow addition of buttons.
//		 */
//        foreach($this->buttonsOnRow as $buttonOnRow)
//        {
//            $buttonOnRow->addButtonsToColumnsArray($this->ajaxColumns);
//        }
//		return $this->builder()
//					->columns($this->ajaxColumns)
//					->ajax(asset('customer/selection'))
//					->parameters($this->getBuilderParameters());
//	}
}
