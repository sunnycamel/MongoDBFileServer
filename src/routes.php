<?php
Route::get('/fileserver/{id}', function($id){
          FileServer::get($id);
     });