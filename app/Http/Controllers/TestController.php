<?php
	namespace App\Http\Controllers;
	use App\Http\Controllers\Controller;
	
	class TestController extends Controller
	{
		public function show($param)
		{
			return $param; // выводим параметр в браузер
		}
	}

?>