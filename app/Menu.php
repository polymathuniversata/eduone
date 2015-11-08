<?php

namespace App;

class Menu
{
	public static function render()
	{
		$menu = '<ul class="list-unstyled">';

		foreach (config('menu') as $properties) :

			$parent_active = self::checkActive($properties['url']);

			$child_active = '';
			if ( ! empty($properties['childs']))
			{
				foreach ($properties['childs'] as $child_properties) {
					$child_active = self::checkActive($child_properties['url']);
				}
			}

			$menu .= '<li class="' . $parent_active . ' ' . $child_active . '"><a href="' . url($properties['url']) . '">';
			
			if ($properties['icon'])
				$menu .= '<i class="' . $properties['icon'] . '"></i>';
			
			$menu .= $properties['title'];

			if ( ! empty($properties['childs'])) {
                $menu .= '<span class="caret pull-right"></span>';
	            
	            if ( $parent_active === 'active' || $child_active === 'active' ) :
	                $menu .= '<ul class="list-unstyled">';

	                foreach($properties['childs'] as $child_properties) :

		                $menu .= '<li class="' . self::checkActive($child_properties['url']) . '">
		                    <a href="' . url($child_properties['url']) . '">' . $child_properties['title'] . '</a>
		                </li>';

	                endforeach;
	                $menu .= '</ul>';
	           	endif;
           }

			$menu .= '</a></li>';

		endforeach;

		return $menu . '</ul>';
	}

	public static function checkActive($url)
	{
		$current_path = app('request')->path();
		
		if ($current_path === $url)
			return 'active';

		return '';
	}
}