<?php 

class Menu {

	public static function activeMenu($uri='')
	{
		$active = '';
		if(is_array($uri)){
			$active = self::activeMenuArr($uri);
		} else {
			$active = self::activeMenuString($uri);
		}
		return $active;
	}

	private static function activeMenuString($uri='')
	{
		$active = '';
		$arr = explode('.', $uri);

		if($uri === 'home' &&  Request::segment(1) === null){
			$active = 'active';			
		}

		if(count($arr) === 2){
			if ( Request::route()->getName() === $uri || (Request::segment(1) === $arr[0] && Request::segment(1) === $arr[1] ) ){
				$active = 'active';
			}
		}
		else{
			//dd(Request::segment(1));
			if ( (Request::segment(1) === $arr[0] ) ){
				$active = 'active';
			}
		}
		return $active;		
	}

	private static function activeMenuArr($uri = [])
	{
		$active = '';
		foreach($uri as $url){
			$active .= self::activeMenuString($url);
		}
		return $active;
	}
	

}