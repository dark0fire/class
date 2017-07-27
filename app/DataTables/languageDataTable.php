<?php

namespace App\DataTables;

use App\Models\language;
use App\Models\translation;
use App\Models\translationKey;
use Yajra\Datatables\Datatables;
use Illuminate\Contracts\View\Factory;

class languageDataTable extends baseDataTable
{

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {

    	$translations = translation::get()->toArray();
        $translationKeys = translationKey::get(['id', 'key'])->toArray();
        foreach($translationKeys as &$translationKey)
		{
			foreach($translations as &$translation)
			{
				foreach($this->languages as &$language)
				{
					if($translation['translation_key_id'] == $translationKey['id'] and $translation['language_id'] == $language['language_id'])
					{
						$translationKey[$language['language_id']] = $translation['translation'];
					}
					else
					{
						if(empty($translationKey[$language['language_id']]))
						{
							$translationKey[$language['language_id']] = '';
						}
					}

				}
			}
		}
        return $this->applyScopes($translationKeys);
    }

    function buildAjaxColumns()
	{

	}

	/**
	 * @var array, show these columns in the table
	 */
	public $ajaxColumns;

    function __construct(Datatables $datatables, Factory $viewFactory)
	{
		$this->ajaxColumns = [
			'key' => ['title' => trans('msg.col_language_id')],
		];
		$this->languages = language::get()->toArray();
		foreach($this->languages as $language)
		{
			$this->ajaxColumns[$language['language_id']] = ['title' => $language['language']];
		}


		parent::__construct($datatables, $viewFactory);
		$this->setDefaultParameters([
//			'select' => [
//				'style' => 'os',
//				'selector' => 'td:first-child',
//				'blurable' => true,
//			],
			'keys' => [
				'columns' => ':not(:first-child)',
//				'editor' => 'd',
			],
		]);
	}

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'languagedatatable_' . time();
    }
}
