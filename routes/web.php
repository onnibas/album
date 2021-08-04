<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//rota do inicio
Route::get('/',[PhotoController::class,'index']);

Route::get('/photos',[PhotoController::class,'showAll']);

//rota do formulário de cadastro
Route::get('/photos/new',[PhotoController::class,'create']);

//rota que exibe o formulario de edição
Route::get('/photos/edit/{id}',[PhotoController::class,'edit']);

//rota que insere uma nova foto no bd
Route::post('/photos', [PhotoController::class,'store']);

//rota que altera a imagem no banco de dados
Route::put('photos/{id}',[PhotoController::class,'update']);

//rota que apaga uma foto do banco de dados
Route::delete('photos/{id}',[PhotoController::class,'destroy']);
