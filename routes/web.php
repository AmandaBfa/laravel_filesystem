<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {

    $contents = Storage::disk('public')->get('teste.txt');
    echo $contents;
});
