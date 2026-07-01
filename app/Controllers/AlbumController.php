<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $album = new Album();

        $albums = $album->all();

        $this->view('albums/index', [

            'albums' => $albums

        ]);
    }
}