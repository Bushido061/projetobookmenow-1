<?php

use App\Http\Controllers\Api\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get("categorias", [CategoriaController::class, "index"]);
Route::post("categorias", [CategoriaController::class,"store"]);
Route::get("categorias/{id}", [CategoriaController::class, "show"]);
Route::put("categorias/{id}", [CategoriaController::class, "update"]);
Route::delete("categorias/{id}", [CategoriaController::class, "destroy"]);
