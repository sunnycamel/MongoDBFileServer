<?php
Route::get('/fileserver/test', function(){
//          $id = FileServer::put('123456789', 'a.txt', 'txt');
          $ret = FileServer::delete('5472c60041fe9555198b456b');
          dd($ret);
     });