<?php namespace Three\Fileserver\Models;

use Jenssegers\Mongodb\Model as Eloquent;
use DB;

class File extends Eloquent {

     protected $connection = 'fileserver';
     protected $collection = 'fs.files';

     public function getFileData()
     {
          $gridfs = DB::connection('fileserver')->getGridFs();
          $file = $gridfs->get(new \MongoId($this->_id));
          
          if($file) {
               return $file->getBytes();
          }
          
          return NULL;
     }

     public function save(array $options = array())
     {
          if( isset($options['update']) and $options['update'] == TRUE ) {
               return parent::save();
          }
          else {
               $gridfs = DB::connection('fileserver')->getGridFs();
               $id = $gridfs->storeBytes($this->filedata, array(
                                              'filename'    => $this->filename,
                                              'filetype'    => $this->filetype,
                                              'keywords'    => $this->keywords,
                                              'description' => $this->description,
                                              )
                    );
               if($id) {
                    return TRUE;
               }
          }

          return FALSE;
     }

     public function delete()
     {
          $gridfs = DB::connection('fileserver')->getGridFs();
          $ret = $gridfs->remove(array('_id' => new \MongoId($this->_id)));
          if($ret['n'] == 1) {
               return TRUE;
          }
          
          return FALSE;
     }

}