<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FilePondController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AllProposalController;
use App\Http\Controllers\Admin\ToggleController;
use App\Http\Controllers\UserPointFilterController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\AdminFilterController;
use App\Http\Controllers\CustomizeAdminInventoryController;
use App\Http\Controllers\CustomizeUsersAllProposalController;
use App\Http\Controllers\UserFilterEvaluationController;
use App\Http\Controllers\UpdatePendingProposalController;
use App\Http\Controllers\DeleteTemporaryEvaluationFilesController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\UploadTemporaryEvaluationFilesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/toggle-update/{id}', [ToggleController::class, 'update'])->name('toggle.update');
Route::post('/toggle-update/{id}', [EvaluationController::class, 'updateSystem'])->name('toggle.update');

Route::post('/toggle-update/user/{id}', [UserController::class, 'updateSystem'])->name('toggle.update-user');

Route::post('/update-data/{id}', [UpdatePendingProposalController::class, 'updateData'])->name('update.data');

Route::post('/upload-image/{id}', [ImageController::class, 'upload'])->name('image.store');

Route::get('/user-filter-points/{id}', [UserPointFilterController::class, 'user_filter_points'])->name('filter.user-points');

Route::get('/user-filter-evaluation/{id}', [UserFilterEvaluationController::class, 'user_filter_evaluation'])->name('filter.user-evaluation');

Route::post('filepond/{proposals}', [FilePondController::class, 'FilePondStore']);
Route::delete('revert/{id}', [FilePondController::class, 'DeleteProposal'])->name('filepond.delete');

Route::post('/evaluationfilepond/{id}', [EvaluateController::class, 'UploadTemporaryFile']);

Route::delete('/deletevaluationfilepond', DeleteTemporaryEvaluationFilesController::class);

Route::post('/update-customize/{id}', [CustomizeAdminInventoryController::class, 'updateData'])->name('update.customize');
Route::post('/update-customize-user-all-proposal/{id}', [CustomizeUsersAllProposalController::class, 'updateData'])->name('update.user-customize-user-all-proposal');


Route::post('/update-customize-user/{id}', [InventoryController::class, 'updateData'])->name('update.user-customize');
Route::get('/update-year-user/{id}', [InventoryController::class, 'filterInventoryYear'])->name('update.user-year');
Route::get('/search-proposal-name/{id}', [InventoryController::class, 'search'])->name('search.proposal-name');




Route::get('/filter-proposal', [AllProposalController::class, 'filterAllProposal'])->name('filter.data');
Route::get('/filter-user-proposal/{id}', [AllProposalController::class, 'filterUserProposal'])->name('filter.data-user');
Route::get('/proposal/search', [AllProposalController::class, 'searchAllProposal'])->name('proposal.search');
Route::get('/proposal/search-my-proposal/{id}', [AllProposalController::class, 'searchMyProposal'])->name('proposal.search-my-proposal');
Route::get('/filter-my-proposal', [AllProposalController::class, 'MyProposal'])->name('filter.proposal');

Route::get('/filter-points', [AdminFilterController::class, 'filter_points'])->name('filter.points');
Route::get('/filter-evaluation', [AdminFilterController::class, 'filter_evaluation'])->name('filter.evaluation');

