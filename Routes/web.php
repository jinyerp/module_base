<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::middleware(['web','auth:sanctum', 'verified'])->group(function () {
    Route::prefix('/jiny')->name('jiny.')->group(function () {

        Route::get('/', function () {
            return view("module-base::jiny");
        });

    });
});



## HR 어드민
Route::middleware(['web','auth:sanctum', 'verified', 'admin', 'super'])->group(function () {
    Route::prefix('/admin/hr')->name('admin.hr.')->group(function () {

        ## 사업장
        Route::get('/business', [
            \Jiny\Erp\Base\Http\Controllers\Admin\BusinessController::class,
            "index"
        ]);

    });
});
