<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InvestigateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CohortController;
use App\Http\Controllers\Admin\ReportController;

use App\Http\Controllers\Auth\LoginController;
use Symfony\Component\Process\Process;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::post('autodeploy', function(){
$process = new Process(['php', '/var/www/html/wtd/deploy.php']);
$process->run();

});
// Auth::routes();
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout',  [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/investigates', InvestigateController::class);
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/assignments', AssignmentController::class);
    Route::resource('admin/reviews', ReviewController::class);
    Route::resource('admin/cohorts', CohortController::class);
    Route::resource('admin/reports', ReportController::class);
});
