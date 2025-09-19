<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [FileController::class, 'index']);

Route::get('/storage_local_create', [FileController::class, 'storageLocalCreate'])->name('storage.local.create');
