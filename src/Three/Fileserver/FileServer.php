<?php namespace Three\Fileserver;

use Three\Fileserver\Models\File;

class FileServer {

     function store ($input_file, $type, $keywords,  $description)
     {
          $file = new File;
          $file->filename    = $input_file->getClientOriginalName();
          $file->filetype    = $type;
          $file->keywords    = $keywords;
          $file->description = $description;
          $file->filedata    = \File::get($input_file->getRealPath());
          $ret = $file->save();
          if($ret) {
               return $file->_id;
          }
          else {
               return NULL;
          }
     }
     
}
