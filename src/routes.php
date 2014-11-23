<?php
Route::get('/fileserver/test', function(){
          $id = FileServer::put('123456789', 'a.txt', 'txt');
          $ret = FileServer::getFileType($id);
          dd($ret);
     });