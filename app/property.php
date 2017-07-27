<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class property extends Model
{
    function materials()
	{
		return $this->belongsToMany(material::class)->withPivot(['unit_id', 'value']);
	}
}
