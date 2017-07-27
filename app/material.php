<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    function properties()
	{
		return $this->belongsToMany(property::class)->withPivot(['unit_id', 'value']);
	}

	static function viewProperties()
	{
		$units = unit::get();
		$materials = self::with('properties')->get()->toArray();
		$properties = property::get()->toArray();
		foreach($materials as &$material)
		{

			foreach($properties as $property)
			{
				foreach($material['properties'] as $materialProperty)
				{
					if($materialProperty['id'] === $property['id'])
					{
						$material[$property['description']] = ['value' => $materialProperty['pivot']['value'], 'unit' => $units->where('id', $materialProperty['pivot']['unit_id'])->first()->description];
					}
					else
					{
						if(empty($material[$property['description']]))
						{
							$material[$property['description']] = '';
						}
					}
				}
			}
			if(isset($material['properties']))
			{
				unset($material['properties']);
			}
			unset($material['id']);
			unset($material['created_at']);
			unset($material['updated_at']);


		}
		return $materials;
	}
}
