<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

View::addLocation(app_path() . '/WelcomePage/Application/Responder/Template');

Route::get('/', static function () {
    return view('welcome');
});
