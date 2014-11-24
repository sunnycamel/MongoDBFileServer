<?php namespace Three\Fileserver;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\DB;

class FileServer {

     protected $config;
     protected $db;
     protected $gridfs;
     

     public function __construct(Repository $config)
     {
          $this->config = $config;
          $this->db     = DB::connection('fileserver');
          $this->gridfs = $this->db->getGridFs();
     }

     public function getFileName($file_id)
     {
          $file = $this->gridfs->get(new \MongoId($file_id));
          
          if($file) {
               return $file->getFilename();
          }
          
          return NULL;
     }

     public function getFileType($file_id)
     {

          $metas = $this->getMetaData($file_id);
          if($metas) {
               if(isset($metas['filetype'])) {
                    return $metas['filetype'];
               }
          }

          return NULL;
     }

     public function getFileData($file_id)
     {
          $file = $this->gridfs->get(new \MongoId($file_id));
          
          if($file) {
               return $file->getBytes();
          }
          
          return NULL;
     }

     public function put($file_data, $file_name, $file_type, $keyword, $description)
     {
          $id = $this->gridfs->storeBytes($file_data, array(
                                         'filename'    => $file_name,
                                         'filetype'    => $file_type,
                                         'keyword'     => $keyword,
                                         'description' => $description,
                                         )
               );
          
          if($id) {
               return $id->{'$id'};
          }

          return NULL;
     }

     public function delete($file_id)
     {
          $ret = $this->gridfs->remove(array('_id' => new \MongoId($file_id)));
          if($ret['n'] == 1) {
               return TRUE;
          }
          
          return FALSE;
     }

     public function search($keyword)
     {
          //search in keywords and description in gridfs' files collection

     }

     private function getMetaData($file_id)
     {
          return $this->db->collection('fs.files')->find($file_id);
     }

}
