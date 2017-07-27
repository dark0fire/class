<?php

namespace App\DataTables;

use App\Models\newsItem;

/**
 * Class exampleDataTable
 *
 * Please not that this is an example and there is no working db connection, copy-paste and edit which model to use.
 *
 *
 * @package App\DataTables
 */
class newsItemDataTable extends baseDataTable
{
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'newsItemDataTable_' . time();
    }

    /**
     * Add column names to show
     * @var array $ajaxColumns
     */
    public $ajaxColumns = [
        'id' => ['title' => '#id', 'width' => '1%', 'orderable' => true],
        'dummy' => ['title' => 'Info', 'width' => '1%', 'orderable' => false, 'searchable' => false, 'defaultContent' => '', 'className' => 'details-control'],
        'sequence' => ['title' => 'Sequence', 'width' => '1%', 'orderable' => true, 'class' => 'reorderSeq'],
        'title' => ['title' => 'News item', 'width' => '30%', 'orderable' => false],
        'content' => ['title' => 'News', 'width' => '30%', 'orderable' => false, 'render' => 'renderNews(data, type, full, meta)'],
        'visible_from_date' => ['title' => 'Visible from', 'width' => '10%', 'orderable' => true, 'render' => 'renderDate(data, type, full, meta)'],
        'visible_until_date' => ['title' => 'Visible till', 'width' => '10%', 'orderable' => false, 'render' => 'renderDate(data, type, full, meta)'],
    ];

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        /**
         * Create your query
         */
        $query = newsItem::select(
            'news_items.news_item_id as id' ,
            'news_items.sequence as sequence' ,
            'news_items.title as title' ,
            'news_items.content as content' ,
            'news_items.visible_from_date as visible_from_date' ,
            'news_items.visible_until_date as visible_until_date'
            //'users_create.name as created_by',
            //'news_items.id as created_by_id',
            //'users_update.name as updated_by',
            //'news_items.id as updated_by_id'
            );
            //->orderBy('news_items.sequence')
            //->leftJoin('users as users_create', 'users_create.id', '=', 'news_items.created_by')
            //->leftJoin('users as users_update', 'users_update.id', '=', 'news_items.updated_by');
        return $this->applyScopes($query);
    }

}
