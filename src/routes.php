<?php
Route::get('/fileserver/test', function(){
          $id = FileServer::put('123456789', 'a.txt', 'txt', 'test file', 'a test file');
          $ret = FileServer::search(array('test'));
          dd($ret);
     });