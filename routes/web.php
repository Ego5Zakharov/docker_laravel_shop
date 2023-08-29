<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('home');
});



