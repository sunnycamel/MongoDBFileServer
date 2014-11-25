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

     public static function search($keywords, $start = NULL, $end = NULL)
     {
          //search in keywords and description fields in gridfs' files collection
          $ret = array();
          foreach($keywords as $keyword) {
               $finds = FileServer::where('keywords', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')->get();//TODO: need to limit the result by start and end
               foreach($finds as $find) {
                    $ret[] = $find['_id']->{'$id'};
               }
          }

          return $ret;
     }

}