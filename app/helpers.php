<?php

if ( ! function_exists( 'array_swap' ) )
{
	/**
	 * This function works like array_flip but allows users use values as array
	 * For example, 
	 * [ foo => ['bar', 'baz'] ]
	 * will becomes
	 * [
	 *   'bar' => 'foo',
	 *   'baz' => 'foo'
	 * ]
	 * 
	 * @param  Array $array Array to be swapped
	 * @return Array array output
	 */
	function array_swap( array $array )
	{
		$swapped = array();
		foreach ( $array as $key => $nested )
		{
			foreach ( (array) $nested as $index => $value )
			{
				$swapped[$value] = $key; 
			}
		}
		return $swapped;
	}
}

function array_flip_deep(array $array)
{
	$flipped = [];

	foreach ($array as $key => $value) {
		$flipped[$value][] = $key;
	}

	return $flipped;
}

function get_slot($id)
{
	foreach (config('settings.slots') as $slot) {
		if ($slot['id'] === $id)
			return $slot;
	}
}

function get_slot_time($slot)
{
	if ( ! is_array($slot))
		$slot = get_slot($slot);

	return array_map('trim', explode('-', $slot['time']));
}

if ( ! function_exists('isset_all')) 
{
	function isset_all(...$vars)
	{
		foreach ($vars as $var) {
			if ( ! isset($var))
				return false;
		}

		return true;
	}
}

if ( ! function_exists('isset_any')) 
{
	function isset_any(...$vars)
	{
		foreach ($vars as $var) {
			if (isset($var))
				return true;
		}

		return false;
	}
}

if ( ! function_exists('isset_val'))
{
	function isset_val($var, $value = '')
	{
		if (empty($value) && is_integer($var))
			$value = 0;

		return isset($var) ? $var : $value;
	}
}

if ( ! function_exists('ss'))
{
	/**
	 * Spaceship operator
	 */
	function ss($a, $b)
	{
		if ($a > $b)
			return 1;

		if ($a == $b)
			return 0;

		return -1;
	}
}

function average_of($marks)
{
	// Todo: Get Calculation method from Setting::('calculation_method')
	$calculation_method = 'arithmetic_mean';

	$average = 0;

	foreach ($marks as $mark) {
		if ($calculation_method === 'percent')
			$average += $mark['value'] * $mark['percent'] / 100;
		else
			$average += $mark['value'] * $mark['percent'] / array_sum(array_pluck($marks, 'percent'));	
	}

	return round($average, 1);
}