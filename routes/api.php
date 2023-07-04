<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\PurchaseController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('siteInfo', [APIController::class, 'siteInfo']);
Route::get('services', [APIController::class, 'services']);
Route::get('service-events/{slug}', [APIController::class, 'serviceEvents']);
Route::get('eventslist', [APIController::class, 'eventslist']);
Route::get('portfolios', [APIController::class, 'portfolios']);
Route::get('portfolios/album/{slug}', [APIController::class, 'portfolioImageAlbumDetail']);
Route::get('events-details/{slug}', [APIController::class, 'eventsDetails']);
Route::get('ourTeam', [APIController::class, 'ourTeam']);
Route::get('testimonials', [APIController::class, 'testimonials']);
Route::get('packages', [APIController::class, 'packages']);
Route::get('package/{slug}', [APIController::class, 'packageDetail']);
Route::post('signup', [APIController::class, 'register']);
Route::post('signin', [APIController::class, 'login']);
Route::post('verifycode', [APIController::class, 'verifycode']);
Route::post('eventenqueries', [APIController::class, 'eventenqueries']);
Route::post('purchase-tickets', [PurchaseController::class, 'purchaseTickets']);
Route::post('purchase-package', [PurchaseController::class, 'purchasePackage']);
Route::post('cart-items', [APIController::class, 'cartItems']);
Route::post('forgot-password', [APIController::class, 'forgotPassword']);
Route::post('reset-password', [APIController::class, 'resetPassword']);
Route::post('subscribe', [APIController::class, 'subscribe']);
Route::post('contact-us', [APIController::class, 'contactUs']);
Route::get('header-videos', [APIController::class, 'headerVideos']);

/************************* Login User Routes ******************************/
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('logout', [UsersController::class, 'logout']);
    Route::get('profile', [UsersController::class, 'profile']);
    Route::post('profile-update', [UsersController::class, 'profileUpdate']);
    Route::post('wishlist-items', [UsersController::class, 'wishlistItems']);  
    Route::post('wishlist-remove', [UsersController::class, 'wishlistRemove']);     
    Route::get('wishlist', [UsersController::class, 'wishlist']);
    Route::post('purchase-tickets-auth', [PurchaseController::class, 'purchaseTickets']);
	Route::post('purchase-package-auth', [PurchaseController::class, 'purchasePackage']);
	Route::get('subscriptions', [UsersController::class, 'subscriptions']);
	Route::get('booked-events', [UsersController::class, 'bookedEvents']);
    Route::post('order-tickets', [UsersController::class, 'orderTickets']);    

});
/************************* Login User Routes*********************************/