<?php

namespace Algad\Photography\Controllers;

use Response;
use View;
use Illuminate\Support\Facades\Redirect;

class AlbumController extends Controller
{

    public function getDisplayAlbum($path)
    {
        return Redirect::to('/album?path=' . $path);
    }

    public function getDisplayAlbumList($path)
    {
        return Redirect::to('/album-list?path=' . $path);
    }

}
