<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagUserController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\YearController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\AllProposalController;
use App\Http\Controllers\ProfileRoleController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserWelcomeController;
use App\Http\Controllers\Admin\ToggleController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\LnuAdditionalController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProjectProposalController;
use App\Http\Controllers\UserAuthProfileController;
use App\Http\Controllers\Admin\AdminPointController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\OtherSettingsController;
use App\Http\Controllers\Admin\AdminInventoryController;

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

// Route::get('/weclome', [UserController::class, 'notify'])->name('welcome');

Route::controller(PostController::class)->group(function () {
    Route::get('/', 'lnuShow')->name('lnu');
    Route::get('/dashboard', 'index')->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/proposal', 'proposal')->middleware(['auth', 'verified'])->name('proposal');
    Route::get('/mark-as-read/{id}', 'markasread')->name('markasread');
});

Route::controller(ProviderController::class)->group(function () {
    Route::get('/login-google', 'redirectProvider')->name('google.login');
    Route::get('/auth/google/callback', 'handleCallback')->name('google.login.callback');
});

Route::controller(LnuAdditionalController::class)->group(function () {
    Route::get('/lnu-events',  'lnuEvent')->name('lnu-additional-partials.event-additionals');
    Route::get('/lnu-news',  'lnuNews')->name('lnu-additional-partials.news-additionals');
    Route::get('/lnu-articles','lnuFeatures')->name('lnu-additional-partials.features-additionals');
    Route::get('/show-event/{id}',  'showEvent')->name('lnu-show-details.show-event');
    Route::get('/show-news/{id}', 'showNews')->name('lnu-show-details.show-news');
    Route::get('/show-articles/{id}', 'showFeatures')->name('lnu-show-details.show-article');

});


// Route for Admin
Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function(){

    Route::controller(IndexController::class)->group(function () {
        Route::get('/',  'index')->name('dashboard.index');
        Route::post('/create-proposal', 'store')->name('store');
        Route::get('/proposal/admin-dashboard-search', 'search')->name('proposal.admin-dashboard-search');
        Route::get('/proposal/admin-dashboard-filter',  'filter')->name('proposal.admin-dashboard-filter');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::resource('/roles', RoleController::class);
        Route::post('/roles/{role}/permissions',  'givePermission')->name('roles.permissions');
        Route::delete('/roles/{role}/permissions/{permission}','revokePermission')->name('roles.permissions.revoke');
    });


    Route::controller(PermissionController::class)->group(function () {
        Route::resource('/permissions', PermissionController::class);
        Route::post('/permissions/{permission}/roles', 'assignRole')->name('permissions.roles');
        Route::delete('/permissions/{permission}/roles/{role}','removeRole')->name('permissions.roles.remove');
    });


    Route::controller(UserController::class)->group(function () {
        Route::get('/main','mainIndex')->name('users.main');
        Route::get('/search','searchUser')->name('users.search');
        Route::get('/users','index')->name('users.index');
        Route::get('/users/{user}','show')->name('users.show');
        Route::patch('/users/{id}','update')->name('users.update');
        Route::delete('/users/{user}','destroy')->name('users.destroy');
        Route::post('/users/{user}/roles','assignRole')->name('users.roles');
        Route::delete('/users/{user}/roles/{role}','removeRole')->name('users.roles.remove');
        Route::post('/users/{user}/permission','givePermission')->name('users.permissions');
        Route::delete('/users/{user}/permissions/{permission}', 'revokePermission')->name('users.permissions.revoke');
        Route::get('/user-search-proposal/{id}','search')->name('users.search-proposal');
        Route::get('/user-status-proposal/{id}','status')->name('users.status-proposal');
        Route::get('/user-years-proposal/{id}','years')->name('users.years-proposal');
        Route::post('/user-filter-customize/{id}','customize')->name('users.filter-customize');
        Route::get('/user-filter-evaluation-year/{id}','FilterEvaluationYear')->name('users.filter-evaluation-year');
        Route::get('/user-filter-evaluation-status/{id}','FilterEvaluationStatus')->name('users.filter-evaluation-status');
    });

    Route::controller(EventController::class)->group(function () {
        Route::get('/events','index')->name('other-events-ceso-events');
        Route::patch('/events/update/{id}','update')->name('other-events-ceso-update-events');
        Route::post('events/store','store')->name('other-events-ceso-store-events');
        Route::get('/events/edit/{id}','edit')->name('other-events-ceso-edit-events');
        Route::delete('/events/delete/{id}','delete')->name('other-events-ceso-delete-events');
    });


    Route::controller(FeatureController::class)->group(function () {
        Route::get('/features','index')->name('features.index');
        Route::post('/features/store','store')->name('features.store');
        Route::patch('/features/update/{id}','update')->name('features.update');
        Route::get('/features/create','create')->name('features.create');
        Route::get('/features/edit/{id}','edit')->name('features.edit');
        Route::delete('/features/delete/{id}','delete')->name('features.delete');

    });


    Route::controller(DashboardController::class)->group(function () {
        Route::get('/upload','create')->name('dashboard.create');
        Route::post('/post-upload','store')->name('dashboard.store');
        Route::get('/dashboard/user-proposal/{id}','checkProposal')->name('dashboard.edit-proposal');
        Route::put('/update-user-proposal/{id}',  'updateDetails')->name('dashboard.update-project-details');
        Route::delete('/delete-user-proposal',  'DeleteProposal')->name('dashboard.delete-project-proposal');
    });


    Route::controller(EvaluationController::class)->group(function () {
        Route::get('/evaluation','index')->name('evaluation.index');
        Route::get('/evaluation/{id}/{year}', 'show')->name('evaluation.show');
        Route::patch('/evaluation-update/{id}', 'update')->name('evaluation.update');
        Route::get('/filters','filters')->name('evaluation.filters');
    });


    Route::controller(ProjectProposalController::class)->group(function () {
        Route::put('/rename/files/{id}','RenameFile')->name('proposal.rename-ongoing-proposal');
        Route::delete('/delete-Mediafile/{id}','deleteMedia')->name('proposal.delete-media-proposal');

        Route::get('/project/{id}','showFaculty')->name('proposal.show_faculty');
        Route::get('download-media/{id}','DownloadMedia')->name('proposal.download-media-files');
        Route::delete('/delete-proposal/{id}','DeleteProposal')->name('proposal.delete-project-proposal');
        Route::delete('/admin-delete-proposal/{id}','AdminDeleteProposal')->name('proposal.admin-delete-project-proposal');
    });

    Route::controller(AdminInventoryController::class)->group(function () {

        Route::get('/admin-inventory','index')->name('inventory.index');
        Route::get('/inventory/admin-search', 'search')->name('inventory.admin-search');
        Route::get('/inventory/admin-filter', 'filter')->name('inventory.admin-filter');
        Route::get('/inventory/admin-sort', 'sort')->name('inventory.admin-sort');
        Route::get('/inventory/admin-sort-file', 'sortfile')->name('inventory.admin-sort-file');
        Route::get('/download-proposal-media/{id}','InventorydownloadMedia')->name('inventory.admin-download-media');
        Route::get('/inventory-show/{id}','show')->name('inventory.proposal-show');
        Route::get('/inventory/{id}','showInventory')->name('inventory.show-inventory');


    });


    Route::controller(AdminPointController::class)->group(function () {
        Route::get('/points', 'index')->name('points.index');
        Route::get('/points/{id}/{year}', 'show')->name('points.show');
        Route::get('/adminfilter','AdminPointsfilter')->name('points.AdminPointsfilter');
    });

    Route::get('/chart', [ChartController::class, 'index'])->name('chart.index');
    Route::get('/edit-toggle/{id}', [ToggleController::class, 'edit'])->name('edit.submit');

    Route::get('/template-index',[OtherSettingsController::class, 'index'])->name('template.index');
    Route::put('/template-update/{id}',[OtherSettingsController::class, 'update'])->name('template.update');
    Route::get('/template-download/{template_name}',[OtherSettingsController::class, 'download'])->name('template.download');
    Route::post('/year-post',[OtherSettingsController::class, 'yearPost'])->name('yearpost.upload');
    Route::post('/faculty-post',[OtherSettingsController::class, 'facultyPost'])->name('facultypost.upload');

});



// Route for Auth User
Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(ProfileRoleController::class)->group(function () {
        Route::post('/assign/{user}/roles', 'assignProfileUser')->name('profile.add.roles');
        Route::delete('/remove/{user}/roles/{role}', 'removeRole')->name('profile.roles.remove');
        Route::get('user-edit-profile/{id}', 'editRoleFaculty')->name('profile.edit-role-faculty');
        Route::patch('user-update-profile/{id}', 'SaveRoleFaculty')->name('profile.update-role-faculty');
        Route::post('/ajaxuploadimg/{id}', 'ImgUploadPost')->name('ajaxuploadimg');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::post('/profile','saveImage')->name('profile.image-upload');
        Route::post('/profile-assign/{user}/roles','assignProfileRole')->name('profile.assign.roles');
        Route::delete('/profile','destroy')->name('profile.destroy');
    });


    Route::controller(UserAuthProfileController::class)->group(function () {
        Route::patch('/profile-patch/{id}', 'updateAuthUser')->name('profile.partials.update-auth-profile');
        Route::get('/profile/{id}', 'editAuthUser')->name('profile.partials.edit-auth-profile');
    });

    Route::controller(ProjectProposalController::class)->group(function () {
        Route::get('/proposal','userIndex')->name('proposal.index');
        // Route::get('/proposal/{id}','userShow')->name('proposal.show');
        Route::get('/create/proposal','createProposal')->name('proposal.create');
        Route::post('/store/proposal','storeProposal')->name('proposal.store');
        Route::delete('/delete/proposal','deleteProposal')->name('proposal.delete');
        Route::get('/proposal/pdf/{id}', 'ProjectProPdf')->name('proposal.show_proposal');
        Route::get('/view/{id}', 'ViewUserProposal')->name('proposal.showed-project-proposal');

        Route::post('/store/proposal-project','storeProposalProject')->name('proposal.store-proposal-project');
    });

    Route::controller(InventoryController::class)->group(function () {
        Route::put('/rename-medias/{id}','RenameFiles')->name('inventory-rename-media');
        Route::put('/update-user/files/{id}','userUpdateFiles')->name('inventroy-update-user-proposal');
        Route::get('/downloads-medias/{id}','DownloadMedias')->name('inventory-download-media');
        Route::delete('/delete-medias/{id}','deleteMedias')->name('inventory-delete-media');
        Route::get('/inventory','index')->name('inventory.index');
        Route::get('/inventory/{id}','show')->name('inventory.show');
        Route::get('/downloads-moa/{id}','downloadsMoa');
        Route::get('/downloads-pdf/{id}','downloadsPdf');
        Route::get('/downloads-special-order/{id}','downloadsSpecialOrder');
        Route::get('/downloads-office/{id}','downloadsOffice');
        Route::get('/downloads-travel/{id}','downloadsTravel');
        Route::get('/downloads-other/{id}','downloadsOther');
        Route::get('/download/{id}','download');
        Route::get('/download-media/{id}','downloadsMedia');
        Route::put('/update-inventory-project-details/{id}', 'UpdateShowInventory')->name('inventory.update-project-details');
        Route::delete('/delete-inventory-proposals/{id}','UserDeleteInventoryProposal')->name('inventory-delete-proposals');
    });

    Route::controller(TemplateController::class)->group(function () {
        Route::get('/create-template', 'create')->name('templates.create-template');
        Route::get('generate-pdf',  'genereatePdf')->name('generate-pdf');
        Route::get('/user-download-template', 'UserTemplateDownload')->name('download.template');
    });

    Route::controller(ProposalController::class)->group(function () {
        Route::put('update-project-details/{id}',  'updateDetails')->name('User-dashboard.update-project-details');
        Route::get('/show-proposal/{id}',  'showProposal')->name('User-dashboard.show-proposal');
        Route::delete('/delete-proposal/{id}',  'UserDeleteProposal')->name('User-dashboard.delete-proposal');
        Route::get("/search",'search');
        Route::get('/makefile',  'fileIndex')->name('index-file');
        Route::get('/find',  'tagsInput')->name('api.skills');
        Route::post('/post-file',  'createDirecrotory')->name('post-index-file');
        Route::get('/Proposal-mark-as-read/{id}',  'Proposalmarkasread')->name('Proposalmarkasread');
        Route::get('/proposal/dashboard-search/{id}',  'search')->name('proposal.user-dashboard-search');
        Route::get('/proposal/dashboard-filter/{id}',  'filter')->name('proposal.user-dashboard-filter');
        Route::resource('/User-dashboard',ProposalController::class);
        Route::get('/user-profile',  'UserProfile')->name('User-dashboard.profile');
        Route::get('/my-proposal',  'MyProposal')->name('User-dashboard.my-proposal');
        Route::get('/my-proposal-search/{id}',  'MyProposalSearch')->name('User-dashboard.my-proposal-search');
        Route::get('/my-proposal-filter-year/{id}',  'MyProposalFilterYear')->name('User-dashboard.my-proposal-filter-year');
    });

        Route::get('/welcome-user',[UserWelcomeController::class, 'WelcomeUser'])->name('auth.welcome-user');

        Route::get('/points', [PointsController::class, 'index'])->name('points-system.index');
        Route::get('/filter', [PointsController::class, 'filter'])->name('points-system.filter');

        Route::get('/evaluate/index', [EvaluateController::class, 'index'])->name('evaluate.index');
        Route::get('/evaluate/{id}', [EvaluateController::class, 'create'])->name('evaluate.create');
        Route::post('/post-evaluate', [EvaluateController::class, 'post'])->name('evaluate.post');
        Route::get('/filter/evaluate/index', [EvaluateController::class, 'EvaluateFilterIndex'])->name('evaluate.EvaluateFilterIndex');
        Route::get('/evaluate-pdf/{id}', [EvaluateController::class, 'evaluatePdf'])->name('evaluate-pdf');

        Route::get('/allProposal', [AllProposalController::class, 'index'])->name('allProposal.index');
        Route::post('update-proposal/{proposal}', [SelectController::class, 'update']);
        Route::delete('/delete-uploaded-file/{id}', [EvaluateController::class, 'deleteFile']);


});


    Route::controller(TagUserController::class)->group(function(){
        Route::get('demo-search', 'index');
        Route::post('get-category', 'autocomplete')->name('get-category');
    });

require __DIR__.'/auth.php';
