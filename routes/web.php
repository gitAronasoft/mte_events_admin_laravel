<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminPortfoliosController;
use App\Http\Controllers\Admin\AdminTeamsController;
use App\Http\Controllers\Admin\AdminTestimonialsController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\DashboardAnalystController;

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

Route::get('/', [IndexController::class, 'homePage']);
Route::get('admin', [IndexController::class, 'login']);
Route::post('admin', [IndexController::class, 'adminLogin']);
Route::get('admin/logout', [IndexController::class, 'logout']);
Route::get('admin/dashboard', [IndexController::class, 'dashboard'])->middleware('admin');
Route::get('admin/event/list', [AdminEventController::class, 'eventList'])->middleware('admin');
Route::get('admin/event/add', [AdminEventController::class, 'eventAdd'])->middleware('admin');
Route::post('admin/event/add', [AdminEventController::class, 'eventSave'])->middleware('admin');
Route::get('admin/event/edit/{slug}', [AdminEventController::class, 'editEvent'])->middleware('admin');
Route::post('admin/event/update', [AdminEventController::class, 'UpdateEvent'])->middleware('admin');
Route::get('admin/event/sevices/list', [AdminEventController::class, 'sevicesList'])->middleware('admin');
Route::get('admin/event/eventenquiry/list', [AdminEventController::class, 'eventenquiry'])->middleware('admin');
Route::get('admin/event/sevices/add', [AdminEventController::class, 'addSevices'])->middleware('admin');
Route::post('admin/event/sevices/add', [AdminEventController::class, 'SaveSevices'])->middleware('admin');
Route::get('admin/event/sevices/edit/{slug}', [AdminEventController::class, 'editSevices'])->middleware('admin');
Route::post('admin/event/sevices/update', [AdminEventController::class, 'UpdateSevices'])->middleware('admin');
Route::get('admin/general-setting', [IndexController::class, 'generalSetting'])->middleware('admin');
Route::post('admin/general-setting', [IndexController::class, 'SaveGeneralSetting'])->middleware('admin');
Route::get('admin/profile', [IndexController::class, 'profile'])->middleware('admin');
Route::post('admin/profile', [IndexController::class, 'updateProfile'])->middleware('admin');

Route::get('admin/header/video', [IndexController::class, 'headerVideos'])->middleware('admin');
Route::get('admin/header/video/add', [IndexController::class, 'AddHeaderVideos'])->middleware('admin');
Route::post('admin/header/video/add', [IndexController::class, 'SaveHeaderVideos'])->middleware('admin');
Route::get('admin/header/video/edit/{id}', [IndexController::class, 'EditHeaderVideos'])->middleware('admin');
Route::post('admin/header/video/edit/{id}', [IndexController::class, 'UpdateHeaderVideos'])->middleware('admin');
Route::get('admin/header/video/delete/{id}', [IndexController::class, 'DeleteHeaderVideos'])->middleware('admin');

Route::get('admin/portfolios', [AdminPortfoliosController::class, 'portfolios'])->middleware('admin');

Route::get('admin/portfolios/photo-albums', [AdminPortfoliosController::class, 'photoAlbums'])->middleware('admin');
Route::get('admin/portfolios/photo-albums/add-album', [AdminPortfoliosController::class, 'addPhotoAlbums'])->middleware('admin');
Route::post('admin/portfolios/photo-albums/add-album', [AdminPortfoliosController::class, 'savePhotoAlbums'])->middleware('admin');
Route::get('admin/portfolios/photo-albums/edit/{slug}', [AdminPortfoliosController::class, 'EditPhotoAlbums'])->middleware('admin');
Route::post('admin/portfolios/photo-albums/edit/{slug}', [AdminPortfoliosController::class, 'updatePhotoAlbums'])->middleware('admin');
Route::get('admin/portfolios/photo-albums/delete/{slug}', [AdminPortfoliosController::class, 'deletePhotoAlbums'])->middleware('admin');
Route::get('admin/portfolios/image-delete/{albumID}/{imageID}', [AdminPortfoliosController::class, 'portfolioImageDelete'])->middleware('admin');

Route::get('admin/portfolios/video/list', [AdminPortfoliosController::class, 'videoAlbums'])->middleware('admin');
Route::get('admin/portfolios/video/add', [AdminPortfoliosController::class, 'addVideoAlbum'])->middleware('admin');
Route::post('admin/portfolios/video/add', [AdminPortfoliosController::class, 'saveVideoAlbum'])->middleware('admin');
Route::get('admin/portfolios/video/delete/{slug}', [AdminPortfoliosController::class, 'deleteVideoAlbums'])->middleware('admin');
Route::get('admin/portfolios/video/edit/{slug}', [AdminPortfoliosController::class, 'editVideoAlbums'])->middleware('admin');
Route::post('admin/portfolios/video/edit/{slug}', [AdminPortfoliosController::class, 'updateVideoAlbums'])->middleware('admin');

// Route::post('admin/portfolios/upload-photos', [AdminPortfoliosController::class, 'uploadPhotos'])->middleware('admin');

// Route::post('admin/portfolios/upload-videos', [AdminPortfoliosController::class, 'uploadvideos'])->middleware('admin');


Route::get('admin/teams', [AdminTeamsController::class, 'teams'])->middleware('admin');
Route::get('admin/teams/add', [AdminTeamsController::class, 'AddTeamMember'])->middleware('admin');
Route::post('admin/teams/add', [AdminTeamsController::class, 'SaveTeamMember'])->middleware('admin');
Route::get('admin/teams/edit/{id}', [AdminTeamsController::class, 'EditTeamMember'])->middleware('admin');
Route::post('admin/teams/update', [AdminTeamsController::class, 'updateTeamMember'])->middleware('admin');
Route::get('admin/teams/delete/{id}', [AdminTeamsController::class, 'deleteTeamMember'])->middleware('admin');
Route::get('admin/teams/trash/members', [AdminTeamsController::class, 'trashMembers'])->middleware('admin');
Route::get('admin/testimonials', [AdminTestimonialsController::class, 'testimonials'])->middleware('admin');
Route::get('admin/testimonials/add', [AdminTestimonialsController::class, 'addTestimonial'])->middleware('admin');
Route::post('admin/testimonials/add', [AdminTestimonialsController::class, 'saveTestimonial'])->middleware('admin');
Route::get('admin/testimonials/edit/{id}', [AdminTestimonialsController::class, 'EditTestimonial'])->middleware('admin');
Route::post('admin/testimonials/update', [AdminTestimonialsController::class, 'updateTestimonial'])->middleware('admin');
Route::get('admin/testimonials/delete/{id}', [AdminTestimonialsController::class, 'deleteTestimonial'])->middleware('admin');

Route::get('admin/packages/features', [PackagesController::class, 'features'])->middleware('admin');
Route::get('admin/packages/add-feature', [PackagesController::class, 'AddFeature'])->middleware('admin');
Route::post('admin/packages/add-feature', [PackagesController::class, 'SaveFeature'])->middleware('admin');
Route::get('admin/packages/features/edit/{id}', [PackagesController::class, 'EditFeatures'])->middleware('admin');
Route::post('admin/packages/update-feature', [PackagesController::class, 'UpdateFeatures'])->middleware('admin');
Route::get('admin/packages/features/delete/{id}', [PackagesController::class, 'TrashFeature'])->middleware('admin');

Route::get('admin/packages/list', [PackagesController::class, 'packagesList'])->middleware('admin');
Route::get('admin/packages/add', [PackagesController::class, 'packageAdd'])->middleware('admin');
Route::post('admin/packages/add', [PackagesController::class, 'SavePackage'])->middleware('admin');
Route::get('admin/packages/edit/{id}', [PackagesController::class, 'EditPackage'])->middleware('admin');
Route::post('admin/packages/update', [PackagesController::class, 'updatePackage'])->middleware('admin');
Route::get('admin/packages/delete/{id}', [PackagesController::class, 'trashPackage'])->middleware('admin');

#---------------Dashboard Analyst functions ----------#
Route::get('admin/dashboard', [DashboardAnalystController::class, 'totalOrder'])->middleware('admin');
