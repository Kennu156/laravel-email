<?php

use App\Console\Commands\TimetableNotification;
use App\Mail\Timetable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mailable', function () {
    $data = app(TimetableNotification::class)->handle();
  
    // All the code logic from timetableNotification commands handle() method
    
    return new Timetable($data);
    });
