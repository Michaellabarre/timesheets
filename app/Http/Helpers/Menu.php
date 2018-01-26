<?php 

class Menu {

	public static function activeMenu($uri='')
	{
		$active = '';

		//dd(\Request::route()->getName());
		$arr = explode('.', $uri);
		//dd(Request::segment(1));

		if($uri === 'home' &&  Request::segment(1) === null){
			$active = 'active';			
		}

		if(count($arr) === 2){
			if ( Request::route()->getName() === $uri || (Request::segment(1) === $arr[0] && Request::segment(1) === $arr[1] ) )
			{
				$active = 'active';
			}
		}
		else{
			//dd(Request::segment(1));
			if ( (Request::segment(1) === $arr[0] ) )
			{
				$active = 'active';
			}
		}


		return $active;
	}
	

}