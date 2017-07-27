<?php

namespace App\DataTables;


use App\DataTables\Buttons\noButtons;
use Illuminate\Contracts\View\Factory;

use Illuminate\Support\Collection;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Services\DataTable;

class baseDataTable extends DataTable
{

	/**
	 * Keep ajaxUrl in here so we can pass it into existing functionality if required
	 * @var string
	 */
	protected $ajaxUrl = '';
	/**
	 * A list of searchable columns
	 * @var array
	 */
	public $searchableColumns = [];
	/**
	 * @var bool A token for building a footer
	 */
	public $hasFooter = false;
	/**
	 * @var $ajaxColumns A list of column names to show
	 */
	public $ajaxColumns;

	/**
	 * @var $queryColumns A list of column names to load from db
	 */
	public $queryColumns;

	/**
	 * @var $buttonsOnRow
	 */
	protected $buttonsOnRow;

	/**
	 * @var debug $debug A helper for debugging.
	 */
	protected $debug;

	/**
	 * @var ILog $logger A helper to show messages
	 */
	protected $logger;

    /**
     * @var $builderParameters DataTable main parameters (including language pack)
     */

    private $builderParameters = [];

	/**
	 * baseDataTable constructor.
	 * @param Datatables $datatables
	 * @param Factory $viewFactory
	 */
	public function __construct(Datatables $datatables, Factory $viewFactory)
	{
		$this->datatables   = $datatables;
		$this->viewFactory  = $viewFactory;
		$this->buttonsOnRow = new Collection(new noButtons()); //By default, no buttons are added
//		$this->debug        = new debug(0);
//		$this->logger       = new dumpLogger();
		$this->addColumnNameAsClass();

	}

	/**
	 * Add the column name as class for those fields
	 */
	function addColumnNameAsClass()
	{
		if(!empty($this->ajaxColumns))
		{
			foreach($this->ajaxColumns as $key => &$column)
			{
				$class = '';
				if(!empty($column['class']))
				{
					$class = $column['class'] . ' ';
				}
				$class .= $key;
				$column = array_merge($column, compact('class'));
			}
		}

	}

	/**
	 * Remove timestamps from column list
	 */
	function hideBasicTimestampsOnAjax()
	{
		$this->hideAjaxColumns(['created_at', 'updated_at']);
	}

	/**
	 * @param $column Column name(string)
	 *
	 */
	function hideAjaxColumn($column)
	{
		$key = array_search($column, $this->ajaxColumns);
		unset($this->ajaxColumns[$key]);

	}

	/**
	 * Override render to add task of adding footer to the page
	 * @param string $view
	 * @param array $data
	 * @param array $mergeData
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	function render($view, $data = [], $mergeData = [])
	{
		$hasFooter = $this->hasFooter;
		$data = array_merge($data, compact('hasFooter'));
		return parent::render($view, $data, $mergeData);
	}

	/**
	 * Make the columns for this table searchable
	 */
	function searchableColumns($searchableColumns = null)
	{
		if(empty($searchableColumns))
		{
			if(empty($this->searchableColumns))
			{
				return;
			}
			else
			{
				$searchableColumns = $this->searchableColumns;
			}
		}


//		$this->hasFooter = true;//Removed this because we do not really want the footer to be visible
		$this->setDefaultParameters([
			'initComplete' => "function () {
				var searchableColumns = " . json_encode($searchableColumns) . "
				var api = this.api();
				var self = this;
				var row = document.createElement(\"tr\");
				$.each(api.settings().init().columns, function(key, value)
				{
					var index = searchableColumns.indexOf(value.class);
					if(index != -1)
					{
						var column = document.createElement(\"th\");
						$(column).appendTo(row);
						var input = document.createElement(\"input\");
						$(input).addClass('dt_select_input');
						$(input).addClass('form-control');
						$(input).appendTo(column)
						.on('keyup', function () 
						{
							api.column(key).search_array($(this).val(), false, false, true).draw();
						});
					}
					else
					{
						var column = document.createElement(\"th\");
						$(column).appendTo(row);
					}
				});
				$('thead').append(row);
			}",
		]);
	}

	/**
	 * @param $array Array of column names(string)
	 */
	function hideAjaxColumns($array)
	{
		/**
		 * Only parse if $array is an array
		 */
		if(is_array($array))
		{
			foreach($array as $column)
			{
				/**
				 * Only parse if $column is a string.
				 */
				if(is_string($column))
				{
					$this->hideAjaxColumn($column);
				}
			}
		}
		else
		{
			if(is_string($array))
			{
				$this->hideAjaxColumn($array);
			}
			else
			{
				$this->logger->log('Unusable parameter provided.');
			}

		}
	}

	/**
	 * @param buttonsOnRow $buttons Predefined button addition.
	 */
	function setButtonsOnRow(buttonsOnRow $buttons)
	{

		if(isset($this->viewOnly))
		{
			$buttons->setViewOnly($this->viewOnly);
		}
		$this->buttonsOnRow->reject(function ($value, $key) {
			return $value instanceof noButtons;
		});
		$this->buttonsOnRow->push($buttons);
//		foreach($this->buttonsOnRow as $key => $buttonOnRow)
//		{
//			if($buttonOnRow instanceof noButtons)
//			{
//				unset($this->buttonsOnRow[$key]);
//			}
//		}
//		$this->buttonsOnRow[] = $buttons;
	}

	/**
	 * Display ajax response.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function ajax()
	{
		/**
		 * Use addButtonsToAjax in the middle of the ajax query to allow addition of buttons.
		 */

		$data = $this->datatables->of($this->query());
		$doNotEscape = new Collection();
		foreach($this->buttonsOnRow as $buttonOnRow)
		{
			if(!empty($buttonOnRow))
			{
				$data = $buttonOnRow->addButtonsToAjax($data);
				foreach($buttonOnRow->doNotEscape as $value)
				{
					$doNotEscape->push($value);
				}
			}

		}
		$data->rawColumns($doNotEscape->toArray());
		return $data->make(true);
	}

	/**
	 * Needs to be overWritten by children
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
	 */
	public function query()
	{

	}

	/**
	 * Set ajax url for later use
	 * @param $url
	 */
	function setAjaxUrl($url)
	{
		$this->ajaxUrl = asset($url);
	}

	public function html()
	{
		/**
		 * Use addButtonsToColumnsArray in the middle to allow addition of buttons.
		 */
		foreach($this->buttonsOnRow as $buttonOnRow)
		{
			if(!empty($buttonOnRow))
			{
				$buttonOnRow->addButtonsToColumnsArray($this->ajaxColumns);
			}

		}
		return $this->builder()
			->columns($this->ajaxColumns)
			->ajax($this->ajaxUrl)
            ->parameters($this->builderParameters);
	}

    public function setDefaultParameters($customParameters) {
        $defaultParameters = [
            'responsive' => true,
            'paging' => true,
//            'iDisplayLength' => 15,
//            'dom' => 'Blfrtip',
            'language' => [
                'url' => asset('plugins/datatables/languages/' . user::getSession()->language->language_id . '.json'),
                'decimal' => ',',
                'thousands' => '.'
            ],
            'order'   => [[0, 'desc']]
        ];
		$this->builderParameters = array_merge($defaultParameters, $this->builderParameters);
        $this->builderParameters = array_merge($this->builderParameters, $customParameters);
        return $this->builderParameters;
    }


	/**
	 * Sets parameters for the datatable with row reordering
	 *
	 * @param string $columnName
	 * @param int $columnIndex
	 */
	public function setupRowReorder($columnName, $columnIndex)
	{
		foreach($this->ajaxColumns as $key => $value)
			$this->ajaxColumns[$key]['orderable'] = false;

		$this->ajaxColumns[$columnName]['orderable'] = true;

		$this->setDefaultParameters([
			'rowReorder' => ['dataSrc' => $columnName, 'update' => false, 'selector' => 'td.reorderSeq'],
			'order' => [$columnIndex, 'asc']
		]);
	}
}
