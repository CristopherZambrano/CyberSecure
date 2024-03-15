<?php

use App\Http\Controllers\issues;
use App\Http\Controllers\personController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registerUser', function(Request $request){
    $cller = new personController();
    $values = $cller->RegisterNewUser($request);
    return $values;
});

Route::get('/logIn', function(Request $request){
    $cller = new personController();
    $values = $cller->logIn($request);
    return $values;
});

Route::get('/listIssues',function(){
    $issue = new issues();
    $values = $issue->listIssue();
    return $values;
});

Route::post('addIssues', function(Request $request){
    $issue = new issues();
    return $issue->addIssue($request);
});

Route::post('addLaw', function(Request $request){
    $issue = new issues();
    return $issue->saveLaw($request);
});

Route::post('addAgreement', function(Request $request){
    $issue = new issues();
    return $issue->saveAgreement($request);
});

Route::post('addRecomendations', function(Request $request){
    $issue = new issues();
    return $issue->saveRecomendations($request);
});

Route::get('listResources', function(Request $request){
    $issue = new issues;
    return $issue->ViewDatos($request);
});

Route::get('viewResources', function(Request $request){
    $issue = new issues;
    return $issue->viewpdf($request);
});