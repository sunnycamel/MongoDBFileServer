<?php namespace Three\Fileserver;

use Illuminate\Config\Repository;

class FileServer {

     protected $config;

     public function __construct(Repository $config)
     {
          $this->config = $config;
     }

     public function get($file_id)
     {

     }

     public function put($file_data)
     {

     }

     public function search($keyword)
     {

     }

}
