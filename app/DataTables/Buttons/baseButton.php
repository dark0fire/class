<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 10/07/2017
 * Time: 16:42
 */

namespace App\DataTables\Buttons;


class baseButton
{
	protected $viewOnly;

	function getViewOnly()
	{
		return $this->viewOnly;
	}

	function setViewOnly($viewOnly)
	{
		$this->viewOnly = $viewOnly;
	}
}