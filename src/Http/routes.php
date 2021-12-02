<?php

use DcatAdmin\Ueditor\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::any('ueditor/serve', Controllers\UeditorController::class.'@serve');
