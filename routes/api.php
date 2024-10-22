<?php

use App\Http\Controllers\Api\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get("categorias", [CategoriaController::class, "index"]);
Route::get("categorias/{id}", [CategoriaController::class, "show"]);