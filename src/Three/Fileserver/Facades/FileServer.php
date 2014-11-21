<?php namespace Three\Baidupush\Facades;

use Illuminate\Support\Facades\Facade;

class FileServer extends Facade {

     /**
      * Get the registered name of the component.
      *
      * @return string
      */
     protected static function getFacadeAccessor() { return 'fileserver'; }

}