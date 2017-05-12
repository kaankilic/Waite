<?php
namespace Kaankilic\Waite\Facades;
use Illuminate\Support\Facades\Facade;
 
class Waite extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { 
  	return 'Waite'; 
  }
 
}