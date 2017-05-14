<?php
namespace Kaankilic\Waite\Facades;
use Illuminate\Support\Facades\Facade;

class Waite extends Facade {
	protected static function getFacadeAccessor() { 
		return 'Waite'; 
	}
}