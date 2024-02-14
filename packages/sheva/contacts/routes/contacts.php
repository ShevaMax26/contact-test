<?php

use Illuminate\Support\Facades\Route;
use Sheva\Contacts\Http\Controllers\EmployeeController;


Route::resource('employees', EmployeeController::class)
    ->only(['index', 'store', 'update', 'show', 'destroy']);
