<?php namespace Three\Fileserver;

use Three\Fileserver\Models\File;

class FileServer {

     function store ($file, $type, $keywords,  $description)
     {
          $file = new File;
          $file->filename    = $file->getClientOriginalName();
          $file->filetype    = $type;
          $file->keywords    = $keywords;
          $file->description = $description;
          $file->filedata    = \File::get($file->getRealPath());
          $ret = $file->save();
          
          return $ret;
     }
     
}
