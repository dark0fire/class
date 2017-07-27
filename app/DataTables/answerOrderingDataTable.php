<?php

	namespace App\DataTables;
	use App\Models\xpsA1;
	use App\Models\xpsA2;

	class answerOrderingDataTable extends baseDataTable
	{
		protected $tableID;
		protected $classID;

		/**
		 * Configures this datatable to work on a specific table (xpsA1, xpsA2)
		 * @param $category
		 */
		public function setForTable($category)
		{
			$this->tableID = $category;
		}

		/**
		 * Sets this datatable to return data from given class type
		 * @param $class
		 */
		public function setForClass($class)
		{
			$this->classID = $class;
		}

		public function query()
		{
			$classColumnName = $this->tableID == 'a1' ? 'class1' : 'class2';

			$model = $this->tableID == 'a1' ? xpsA1::query() : xpsA2::query();
			$query = $model->select($this->tableID . '_id AS id', 'descr_nl AS descr', 'remark', 'seq AS sequence')->where($classColumnName, $this->classID);

			return $this->applyScopes($query);
		}

	}
