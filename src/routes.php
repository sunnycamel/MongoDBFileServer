<?php

Route::group(['middleware' => ['web']], function () {
          Route::get('/fileserver/select', 'Three\Fileserver\Controllers\FileserverController@select');

          Route::resource('fileserver', 'Three\Fileserver\Controllers\FileserverController');
          
     });

Route::get('/fileserver/image/{id}', 'Three\Fileserver\Controllers\FileserverController@image');

