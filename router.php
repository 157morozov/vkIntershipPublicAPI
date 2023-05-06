<?php

use app\utils\Route;
use app\controllers\MainController;

Route::get("/", "home");

Route::post("/save", MainController::class, "save", true);
Route::post("/response", MainController::class, "response", true);

Route::init();