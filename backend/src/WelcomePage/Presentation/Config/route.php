<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

View::addLocation(app_path() . '/WelcomePage/Presentation/Http/View');

Route::get('/', static fn() => view('welcome'));
