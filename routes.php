<?php

Route::any('/album/{path}', 'Algad\Photography\Controllers\AlbumController@getDisplayAlbum')->where('path', '(.*)?');
Route::any('/album-list/{path}', 'Algad\Photography\Controllers\AlbumController@getDisplayAlbumList')->where('path', '(.*)?');
Route::post('/access/page', 'Algad\Photography\Controllers\PageSecurityFormController@processRequest');
?>
