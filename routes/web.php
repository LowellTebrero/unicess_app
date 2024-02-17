<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagUserController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\AllProposalController;
use App\Http\Controllers\ProfileRoleController;
use App\Http\Controllers\UserWelcomeController;
use App\Http\Controllers\Admin\ToggleController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\LnuAdditionalController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProjectProposalController;
use App\Http\Controllers\UserAuthProfileController;
use App\Http\Controllers\Admin\AdminPointController;
use App\Http\Controllers\Admin\AdminTrashController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AdminCalendarController;
use App\Http\Controllers\Admin\OtherSettingsController;
use App\Http\Controllers\Admin\AdminInventoryController;
use App\Http\Controllers\Admin\GoogleCalendarController;
use App\Http\Controllers\Admin\ProposalRequestController;
use App\Http\Controllers\Admin\AdminArticleEventController;
use App\Http\Controllers\Admin\AdminProgramServicesController;
use App\Http\Controllers\Admin\AdminPartnerBeneficiaryController;

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
    Route::get('/sendpusher', 'SendPusher');
    Route::get('/dashboard', 'index')->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/proposal', 'proposal')->middleware(['auth', 'verified'])->name('proposal');
    Route::get('/mark-as-read/{id}', 'markasread')->name('markasread');
    Route::get('/mark-all-as-read', 'markAllAsRead')->name('markallsread');
    Route::post('mark-notifications-as-read','markNotificationAsRead')->name('mark-notifications-as-read');
    Route::delete('/remove-notification/{id}', 'RemoveNotification')->name('remove-notification');
    Route::get('/privacy-policy', 'PrivacyPolicy');
    Route::get('/terms-of-services', 'TermsOfServices');
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



Route::get('/pusher', function (){
     return view('pusher');
});


// Route for Admin
Route::middleware(['auth','role:admin'])->name('admin.')->prefix('admin')->group(function(){

    Route::controller(IndexController::class)->group(function () {
        Route::get('/',  'index')->name('dashboard.index');
        // Route::post('/create-proposal', 'store')->name('store');
        Route::get('/proposal/admin-dashboard-search', 'search')->name('proposal.admin-dashboard-search');
        Route::get('/proposal/admin-dashboard-filter',  'filter')->name('proposal.admin-dashboard-filter');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/upload','create')->name('dashboard.create');
        Route::post('/post-upload','store')->name('dashboard.store');
        Route::get('/dashboard/user-proposal/{id}','checkProposal')->name('dashboard.edit-proposal');
        Route::put('/update-user/proposal-file/{id}','AdminUpdateFiles')->name('dashboard-update-user-proposal');
        Route::put('/update-user-proposal/{id}',  'updateDetails')->name('dashboard.update-project-details');
        Route::delete('/delete-user-proposal',  'DeleteProposal')->name('dashboard.delete-project-proposal');
        Route::delete('/delete-user-media',  'DeleteMedia')->name('dashboard.delete-user-media');
        Route::get('/dashboard-chart',  'chart')->name('dashboard.chart-index');
        Route::get('/dashboard-filter-status',  'FilterStatus')->name('dashboard.filter-status');
        Route::get('/dashboard-search-data',  'SearchData')->name('dashboard.search-data');
        Route::get('/dashboard-filter-year',  'FilterYears')->name('dashboard.filter-year');
        Route::get('/dashboard-evaluation-chart',  'EvaluationChart')->name('dashboard.evaluation-chart');

    });

    Route::controller(AdminPointController::class)->group(function () {
        Route::get('/points', 'index')->name('points.index');
        Route::get('/points/{id}/{year}', 'show')->name('points.show');
        Route::get('/adminfilter','AdminPointsfilter')->name('points.AdminPointsfilter');
    });

    Route::controller(EvaluationController::class)->group(function () {
        Route::get('/evaluation-index','index')->name('evaluation.index');
        Route::get('/evaluation/{id}/{year}', 'show')->name('evaluation.show');
        Route::patch('/evaluation-update/{id}', 'update')->name('evaluation.update');
        Route::get('/filters','filters')->name('evaluation.filters');
        Route::delete('/evaluation-delete/{id}','deleteEvaluation')->name('evaluation.delete');
        Route::delete('/evaluation-trash/{id}','TrashEvaluation')->name('evaluation.trash');
        Route::delete('/evaluation-restore/{id}','RestoreEvaluation')->name('evaluation.restore');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/main','mainIndex')->name('users.main');
        Route::get('/search','searchUser')->name('users.search');
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

    Route::controller(AdminInventoryController::class)->group(function () {
        Route::get('/admin-inventory','index')->name('inventory.index');
        Route::get('/inventory/admin-search', 'search')->name('inventory.admin-search');
        Route::get('/inventory/admin-filter', 'filter')->name('inventory.admin-filter');
        Route::get('/inventory/admin-sort', 'sort')->name('inventory.admin-sort');
        Route::get('/inventory/admin-sort-file', 'sortfile')->name('inventory.admin-sort-file');
        Route::get('/download-proposal-media/{id}','InventorydownloadMedia')->name('inventory.admin-download-media');
        Route::get('/inventory-show/{id}','show')->name('inventory.proposal-show');
        Route::get('/inventory/{id}','showInventory')->name('inventory.show-inventory');
        Route::delete('/inventory-delete-media/{id}',  'DeleteMedia')->name('inventory.delete-media');
        Route::delete('/inventory-delete-proposal/{id}','AdminDeleteInventoryProposal')->name('inventory.delete-project-proposal');
    });


    Route::controller(AdminArticleEventController::class)->group(function () {
        Route::get('/article-event','index')->name('article-event.index');
        Route::post('/article/store','ArticlePost')->name('article.store');
        Route::patch('/article/update/{id}','ArticleUpdate')->name('article.update');
        Route::delete('/article/delete/{id}','ArticleDelete')->name('article.delete');
        Route::post('/event/store','EventPost')->name('event.store');
        Route::patch('/event/update/{id}','EventUpdate')->name('event.update');
        Route::delete('/event/delete/{id}','EventDelete')->name('event.delete');
        Route::post('/toggle-update-article-status',  'UpdateToggleFeatureStatus')->name('features.update-article-status');
        Route::post('/toggle-update-event-status', 'UpdateToggleEventStatus')->name('features.update-event-status');
        Route::get('/partner-beneficiary','index')->name('partner-beneficiary.index');
        Route::post('/partner/store','PartnerPost')->name('partner.store');
        Route::delete('/partner/delete/{id}','PartnerDelete')->name('partner.delete');
        Route::patch('/partner/update/{id}','PartnerUpdate')->name('partner.update');
        Route::post('/beneficiary/store','BeneficiaryPost')->name('beneficiary.store');
        Route::delete('/beneficiary/delete/{id}','BeneficiaryDelete')->name('beneficiary.delete');
        Route::patch('/beneficiary/update/{id}','BeneficiaryUpdate')->name('beneficiary.update');
        Route::get('/program-services','index')->name('program-services.index');
        Route::delete('/program-services/delete/{id}','ProgramServicesDelete')->name('program-services.delete');
        Route::patch('/program-services/update/{id}','ProgramServicesUpdate')->name('program-services.update');
        Route::post('/toggle-program-services-status','UpdateToggleStatus')->name('program-services.update-status');
        Route::post('/toggle-program-services-status-physical','UpdateToggleStatustoPhysical')->name('program-services.update-status-physical');
        Route::post('/toggle-program-services-status-information','UpdateToggleStatustoInformation')->name('program-services.update-status-information');
        Route::post('/toggle-program-services-status-literacy','UpdateToggleStatustoLiteracy')->name('program-services.update-status-literacy');
        Route::post('/toggle-program-services-status-cultural','UpdateToggleStatustoCultural')->name('program-services.update-status-cultural');
        Route::post('/toggle-program-services-status-livelihood','UpdateToggleStatustoLivelihood')->name('program-services.update-status-livelihood');
        Route::post('/toggle-program-services-status-environmental','UpdateToggleStatustoEnvironmental')->name('program-services.update-status-environmental');
        Route::post('/toggle-program-services-status-management','UpdateToggleStatustoManagement')->name('program-services.update-status-management');
        Route::post('/toggle-program-services-status-special','UpdateToggleStatustoSpecial')->name('program-services.update-status-special');
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


    Route::controller(ProjectProposalController::class)->group(function () {
        Route::put('/rename/files/{id}','RenameFile')->name('proposal.rename-ongoing-proposal');
        Route::delete('/delete-Mediafile','deleteMedia')->name('proposal.delete-media-proposal');
        Route::delete('/trash-Mediafile','MoveToTrashMedia')->name('proposal.trash-media-proposal');
        Route::delete('/delete-proposal-folder','DeleteProposalFolder')->name('proposal.delete-folder-proposal');
        Route::get('/project/{id}','showFaculty')->name('proposal.show_faculty');
        Route::get('download-media/{id}','DownloadMedia')->name('proposal.download-media-files');
        Route::delete('/delete-proposal/{id}','DeleteProposal')->name('proposal.delete-project-proposal');
        Route::delete('/admin-delete-proposal/{id}','AdminDeleteProposal')->name('proposal.admin-delete-project-proposal');
    });

    Route::controller(OtherSettingsController::class)->group(function () {
        Route::get('/template-index', 'index')->name('template.index');
        Route::post('/year-post', 'yearPost')->name('yearpost.upload');
        Route::post('/faculty-post', 'facultyPost')->name('facultypost.upload');
        Route::post('/template-post', 'PostTemplate')->name('templatepost.upload');
        Route::put('/template-update/{id}', 'TemplateUpdate')->name('template.update');
        Route::delete('/template-delete/{id}/{templateId}', 'deleteMediasTemplate')->name('template.delete');
        Route::get('/calendar-index', 'index')->name('calendar.index');
        Route::post('/calendar-post', 'store')->name('calendar.store');
        Route::patch('/calendar-update/{id}', 'update')->name('calendar.update');
        Route::delete('/calendar-delete/{id}', 'delete')->name('calendar.delete');
    });

    Route::get('/edit-toggle/{id}', [ToggleController::class, 'edit'])->name('edit.submit');

    Route::controller(AdminCalendarController::class)->group(function () {

    });

    Route::get('/admin-trash', [AdminTrashController::class, 'index'])->name('trash.index');
    Route::delete('/admin-trash-restore', [AdminTrashController::class, 'RestoreFile'])->name('trash.restore');
    Route::delete('/admin-trash-hardelete', [AdminTrashController::class, 'DeleteFile'])->name('trash.hardelete');



});



// Route for Auth User
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/calendar', [GoogleCalendarController::class, 'GoogleCalendar'])->name('calendar');

    Route::controller(ProposalController::class)->group(function () {
        Route::put('update-project-details/{id}',  'updateDetails')->name('User-dashboard.update-project-details');
        Route::get('/show-proposal/{id}',  'showProposal')->name('User-dashboard.show-proposal');
        Route::delete('/delete-proposal/{id}',  'UserDeleteProposal')->name('User-dashboard.delete-proposal');
        Route::get("/search",'search');
        Route::get('/makefile',  'fileIndex')->name('index-file');
        Route::get('/find',  'tagsInput')->name('api.skills');
        Route::post('/post-file',  'createDirecrotory')->name('post-index-file');
        Route::get('/proposal/dashboard-search/{id}',  'search')->name('proposal.user-dashboard-search');
        Route::get('/proposal/dashboard-filter/{id}',  'filter')->name('proposal.user-dashboard-filter');
        Route::resource('/User-dashboard',ProposalController::class);
        Route::get('/user-profile',  'UserProfile')->name('User-dashboard.profile');
        Route::get('/my-proposal',  'MyProposal')->name('User-dashboard.my-proposal');
        Route::get('/my-proposal-search/{id}',  'MyProposalSearch')->name('User-dashboard.my-proposal-search');
        Route::get('/my-proposal-filter-year/{id}',  'MyProposalFilterYear')->name('User-dashboard.my-proposal-filter-year');
        Route::get('/get-current-time',  'getCurrentTime');
        Route::post('/get-tag-username', 'GetUserName')->name('proposal.getusername');
        Route::post('/post-tag-username', 'StoreTagName')->name('proposal.storename');

    });



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
        Route::delete('/to-trash-medias/{id}','MoveToTrash')->name('inventory-trash-media');
        Route::delete('/delete-medias/{id}','deleteMedias')->name('inventory-delete-media');
        Route::delete('/delete-medias-permanently/{id}/{proposalId}','deleteMediasPermanently')->name('inventory-delete-media-permanently');
        Route::delete('/restore-medias/{id}','RestoreFile')->name('inventory-restore-media');
        Route::get('/inventory','index')->name('inventory.index');
        Route::get('/inventory/{id}','show')->name('inventory.show');
        Route::get('/downloads-moa/{id}','downloadsMoa')->name('inventory-download-moa');
        Route::get('/downloads-pdf/{id}','downloadProposalPdf')->name('inventory-download-proposalPdf');
        Route::get('/downloads-special-order/{id}','downloadsSpecialOrder')->name('inventory-download-specialPdf');
        Route::get('/downloads-office/{id}','downloadsOffice')->name('inventory-download-officePdf');
        Route::get('/downloads-travel/{id}','downloadsTravel')->name('inventory-download-travelPdf');
        Route::get('/downloads-other/{id}','downloadsOther')->name('inventory-download-otherfile');
        Route::get('/downloads-narrative/{id}','downloadNarrative')->name('inventory-download-narrative');
        Route::get('/downloads-terminal/{id}','downloadTerminal')->name('inventory-download-terminal');
        Route::get('/downloads-travelorder/{id}','downloadTravelorder')->name('inventory-download-travelorder');
        Route::get('/downloads-specialorder/{id}','downloadSpecialorder')->name('inventory-download-specialorder');
        Route::get('/downloads-officeorder/{id}','downloadOfficeorder')->name('inventory-download-officeorder');
        Route::get('/downloads-attendance/{id}','downloadAttendance')->name('inventory-download-attendance');
        Route::get('/downloads-attendancem/{id}','downloadAttendancem')->name('inventory-download-attendancem');
        Route::get('/download/{id}','download');
        Route::get('/download-media/{id}','downloadsMedia');
        Route::put('/update-inventory-project-details/{id}', 'UpdateShowInventory')->name('inventory.update-project-details');
        Route::delete('/delete-inventory-proposals/{id}','UserDeleteInventoryProposal')->name('inventory-delete-proposals');
        Route::delete('/inventory-trashMediafile','MoveToTrashMediaJson')->name('inventory.trash-media-json');
        Route::delete('/inventory-trashFolderMedia','TrashFolderMediaJS')->name('inventory.trash-folder-media-json');
    });

    Route::controller(ReportController::class)->group(function () {
        Route::get('/report-index', 'index')->name('report.index');

        Route::delete('/report-restore-project/{id}', 'RestoreProjectFolder')->name('report-project.restore');
        Route::delete('/report-delete-project/{id}', 'DeleteProjectFolder')->name('report-project.delete');

        Route::post('/report-store-narrative',  'NarrativeStore')->name('report-narrative.store');
        Route::delete('/report-trash-narrative/{id}/{narrativeId}','TrashNarrativeMedias')->name('report-narrative.trash');
        Route::delete('/report-restore-narrative/{id}','RestoreNarrativeMedias')->name('report-narrative.restore');
        Route::delete('/report-delete-narrative/{id}/{narrativeId}','deleteNarrativeMedias')->name('report-narrative.delete');
        Route::post('/report-update-narrative/{id}','NarrativeUpdate')->name('report-narrative.update');

        Route::post('/report-store-terminal', 'TerminalStore')->name('report-terminal.store');
        Route::delete('/report-trash-terminal/{id}/{terminalId}','TrashTerminaMedias')->name('report-terminal.trash');
        Route::delete('/report-restore-terminal/{id}/{terminalId}','RestoreTerminalMedias')->name('report-terminal.restore');
        Route::delete('/report-delete-terminal/{id}/{terminalId}','deleteTerminalMedias')->name('report-terminal.delete');
        Route::post('/report-update-terminal/{id}','TerminalUpdate')->name('report-terminal.update');

        Route::post('/report-store-travelorder',  'travelOrderStore')->name('report-travelorder.store');
        Route::delete('/report-trash-travelorder/{id}/{travelOrderId}','TrashTravelOrderMedias')->name('report-travelorder.trash');
        Route::delete('/report-restore-travelorder/{id}','RestoreTravelOrderMedias')->name('report-travelorder.restore');
        Route::delete('/report-delete-travelorder/{id}/{travelOrderId}','deleteTravelOrderMedias')->name('report-travelorder.delete');
        Route::post('/report-update-travelorder/{id}','travelOrderUpdate')->name('report-travelorder.update');

        Route::post('/report-store-specialorder',  'specialOrderStore')->name('report-specialorder.store');
        Route::delete('/report-trash-specialorder/{id}/{specialOrderId}','TrashSpecialOrderMedias')->name('report-specialorder.trash');
        Route::delete('/report-restore-specialorder/{id}/{specialOrderId}','RestoreSpecialOrderMedias')->name('report-specialorder.restore');
        Route::delete('/report-delete-specialorder/{id}/{specialOrderId}','deleteSpecialOrderMedias')->name('report-specialorder.delete');
        Route::post('/report-update-specialorder/{id}','specialOrderUpdate')->name('report-specialorder.update');

        Route::post('/report-store-officeorder',  'officeOrderStore')->name('report-officeorder.store');
        Route::delete('/report-trash-officeorder/{id}/{officeOrderId}','TrashOfficeOrderMedias')->name('report-officeorder.trash');
        Route::delete('/report-restore-officeorder/{id}/{officeOrderId}','RestoreOfficeOrderMedias')->name('report-officeorder.restore');
        Route::delete('/report-delete-officeorder/{id}/{officeOrderId}','deleteOfficeOrderMedias')->name('report-officeorder.delete');
        Route::post('/report-update-officeorder/{id}','officeOrderUpdate')->name('report-officeorder.update');

        Route::post('/report-store-attendance',  'attendanceStore')->name('report-attendance.store');
        Route::delete('/report-trash-attendance/{id}/{attendanceId}','TrashAttendanceMedias')->name('report-attendance.trash');
        Route::delete('/report-restore-attendance/{id}/{attendanceId}','RestoreAttendanceMedias')->name('report-attendance.restore');
        Route::delete('/report-delete-attendance/{id}/{attendanceId}','deleteAttendanceMedias')->name('report-attendance.delete');
        Route::post('/report-update-attendance/{id}','attendanceUpdate')->name('report-attendance.update');

        Route::post('/report-store-attendancem',  'attendancemStore')->name('report-attendancem.store');
        Route::delete('/report-trash-attendancem/{id}/{attendancemId}','TrashAttendancemMedias')->name('report-attendancem.trash');
        Route::delete('/report-restore-attendancem/{id}/{attendancemId}','RestoreAttendancemMedias')->name('report-attendancem.restore');
        Route::delete('/report-delete-attendancem/{id}/{attendancemId}','deleteAttendancemMedias')->name('report-attendancem.delete');
        Route::post('/report-update-attendancem/{id}','attendancemUpdate')->name('report-attendancem.update');

    });

    Route::controller(TemplateController::class)->group(function () {
        Route::get('/create-template', 'create')->name('templates.create-template');
        Route::get('generate-pdf',  'genereatePdf')->name('generate-pdf');
        Route::get('/user-download-template', 'UserTemplateDownload')->name('download.template');
    });



    Route::controller(AllProposalController::class)->group(function () {
        Route::get('/all-projects', 'index')->name('allProposal.index');
        Route::get('/all-projects-show/{id}', 'show')->name('allProposal.show');

    });

    Route::get('/welcome-user',[UserWelcomeController::class, 'WelcomeUser'])->name('auth.welcome-user');

    Route::get('/points', [PointsController::class, 'index'])->name('points-system.index');
    Route::get('/filter', [PointsController::class, 'filter'])->name('points-system.filter');

    Route::get('/evaluate/index', [EvaluateController::class, 'index'])->name('evaluate.index');
    Route::get('/evaluate/{id}', [EvaluateController::class, 'create'])->name('evaluate.create');
    Route::get('/evaluate-created/{id}', [EvaluateController::class, 'createdEvaluation'])->name('evaluate.created');
    Route::post('/post-evaluate', [EvaluateController::class, 'post'])->name('evaluate.post');
    // Route::get('/filter/evaluate/index', [EvaluateController::class, 'EvaluateFilterIndex'])->name('evaluate.EvaluateFilterIndex');
    Route::get('/evaluate-pdf/{id}', [EvaluateController::class, 'evaluatePdf'])->name('evaluate-pdf')->middleware('auth');

    Route::post('update-proposal/{proposal}', [SelectController::class, 'update']);
    Route::delete('/delete-uploaded-file/{id}', [EvaluateController::class, 'deleteFile']);

    Route::get('trash', [TrashController::class, 'index'])->name('trash.index');
    Route::delete('/trash-restore-fileorfolder', [TrashController::class, 'RestoreFileOrFolder'])->name('trash.restore-fileorfolder');
    Route::delete('/trash-hardelete-fileorfolder', [TrashController::class, 'DeleteFileOrFolder'])->name('trash.hardelete-fileorfolder');


});


    Route::controller(TagUserController::class)->group(function(){
        Route::get('demo-search', 'index');
        Route::post('get-category', 'autocomplete')->name('get-category');
    });

require __DIR__.'/auth.php';
