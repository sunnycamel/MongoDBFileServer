<?php

Route::get('/fileserver/image/{id}', 'Three\Fileserver\Controllers\FileserverController@image');

Route::resource('fileserver', 'Three\Fileserver\Controllers\FileserverController');