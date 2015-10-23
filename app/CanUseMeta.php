<?php

namespace App;

trait CanUseMeta 
{
	public function getMetaTable()
	{
		return $this->table . '_meta';
	}

	public function meta($key, $default = '')
	{
		$meta_table = $this->getMetaTable();
		
		$value = \DB::table($meta_table)
					->where('meta_key', $key)
					->where('object_id', $this->id)
					->value('meta_value');

		return (is_null($value)) ? $default : $value;
	}

	public function hasMeta($key)
	{
		$meta_table = $this->getMetaTable();

		return \DB::table($meta_table)
				->where('meta_key', $key)
				->where('object_id', $this->id)
				->count() > 0;
	}

	public function setMeta($key, $value)
	{
		$meta_table = $this->getMetaTable();

		if ($this->hasMeta($key))
		{
			return \DB::table($meta_table)
				->where('meta_key', $key)
				->where('object_id', $this->id)
				->update([
					'meta_key' 		=> $key,
					'meta_value' 	=> $value,
					'object_id' 	=> $this->id
				]);
		}
		
		return \DB::table($meta_table)
			->insert([
				'meta_key' 		=> $key,
				'meta_value' 	=> $value,
				'object_id' 	=> $this->id
			]);
	}
}