<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\FileUploadController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('signup', [AuthController::class,'signup']);
//    Route::post('edit', [AuthController::class,'edit']);

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
//    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

    Route::post('deleteme', [AuthController::class,'deleteme']);

    Route::get('updateuser', [AuthController::class,'UpdateLoginUser']);

    Route::post('addcarpart', [PartsController::class,'addCarPart']);

    Route::get('getmyparts', [PartsController::class,'getMyParts']);

    Route::delete('deletemypart/{id}', [PartsController::class,'deleteMyPart']);

    Route::post('changemypart/{id}', [PartsController::class,'changeMyPart']);

    Route::post('changemypartimage/{id}', [PartsController::class,'changeMyPartImage']);

    Route::get('getallparts', [PartsController::class,'getAllParts']);

    Route::post('searchallparts', [PartsController::class,'searchAllParts']);

    Route::post('file_upload', [FileUploadController::class,'fileStore']);

    Route::post('file_upload_parts', [FileUploadController::class,'fileStoreParts']);

    Route::get('get_profile_image/{image}', [FileUploadController::class,'getProfileImage']);

    Route::get('get_product_image/{image}', [FileUploadController::class,'getProductImage']);

    Route::post('adminlogin', [AuthController::class,'adminLogin']);

    Route::post('searchdata',[PartsController::class,'searchAllData']);

    Route::post('searchdataadmin',[AuthController::class,'searchAllDataAdmin']);

    Route::post('searchmyparts',[PartsController::class,'searchmyparts']);

    Route::post('searchmypartsselected',[PartsController::class,'SelectedPartData']);

    Route::post('blockuserpart',[PartsController::class,'blockUserPart']);

    Route::post('blockuser',[PartsController::class,'blockUser']);

    Route::post('admingetallusers',[AuthController::class,'adminGetAllUsers']);

    Route::post('usersettings',[AuthController::class,'userSettingsUpdate']);

    Route::post('userupdateimage', [FileUploadController::class,'userUpdateImage']);

    Route::get('getpartbyid/{id}',[PartsController::class,'getPartById']);

    Route::post('addpartimages/{id}/{number}', [FileUploadController::class,'addPartImages']);
});







