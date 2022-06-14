<?php

use App\Http\Controller\Agents\AgentsController;
use App\Http\Controller\Authentication\AuthController;
use App\Http\Controller\Collection\CollectionController;
use App\Http\Controller\Place\PlaceController;
use App\Http\Controller\Plan\PlanController;
use App\Http\Controller\Scheme\SchemeController;
use App\Http\Controller\Search\SearchController;
use App\Http\Controller\Transaction\TransactionController;
use App\Http\Controller\User\UserController;
use App\Lib\Route;


//section for handling Autentication Routes
Route::post('/login', [AuthController::class, 'login']);



//section to handle the agents related Routes
Route::get('/agents', [AgentsController::class, 'index']);
Route::post('/agents', [AgentsController::class, 'store']);
Route::get('/agents/([0-9]*)', [AgentsController::class, 'show'], ["id"]);
Route::post('/agents/([0-9]*)', [AgentsController::class, 'delete'], ["id"]);


//section to handle the Place related Routes
Route::get('/place', [PlaceController::class, 'index']);
Route::post('/place', [PlaceController::class, 'store']);
Route::post('/place/([0-9]*)', [PlaceController::class, 'delete'], ["id"]);



//section to handle the Plan related Routes
Route::get('/plan', [PlanController::class, 'index']);
Route::post('/plan', [PlanController::class, 'store']);


//section to handle the Plan related Routes
Route::get('/scheme', [SchemeController::class, 'index']);
Route::post('/scheme', [SchemeController::class, 'store']);
Route::post('/scheme/([0-9]*)', [SchemeController::class, 'delete'],["id"]);

//section to handle the Users related Routes
Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/([0-9]*)', [UserController::class, 'show'],["id"]);
Route::post('/user/([0-9]*)/update', [UserController::class, 'update'],["id"]);


//section to handle the collection routes 
Route::post('/collection/([0-9]*)/pay',[CollectionController::class,'pay'],["id"]);
Route::get('/collection/([0-9]*)',[CollectionController::class,'show'],["id"]);


//section to handle Transaction related Routes
Route::get('/transaction',[TransactionController::class,'index']);
Route::get('/transaction/([0-9]*)',[TransactionController::class,'show'],['id']);
Route::get('/transaction-today',[TransactionController::class,'todayTransaction']);
Route::post('/transaction-report',[TransactionController::class,'transactionReport']);



//section handleing search 
Route::post('/search',[SearchController::class,'search']);