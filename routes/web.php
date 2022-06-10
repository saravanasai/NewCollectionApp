<?php

use App\Http\Controller\Agents\AgentsController;
use App\Http\Controller\Authentication\AuthController;
use App\Lib\Route;


//section for handling Autentication Routes
Route::post('/login',[AuthController::class,'login']);



//section to handle the agents related Routes
Route::get('/agents',[AgentsController::class,'index']);
Route::post('/agents',[AgentsController::class,'store']);


