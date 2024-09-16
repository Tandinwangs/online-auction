<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\BidController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\AuctionReferenceController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\DzongkhagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserBidController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Bid;
use Spatie\Permission\Contracts\Role;

Route::get('/', [UserController::class, 'index'])->name('userhome');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::namespace('Category')->group(function() {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/categoryAdd', [CategoryController::class, 'store'])->name('category.store');
    Route::patch('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
});

Route::group(['namespace' => 'Item', 'middleware' => 'auth'],function() {
    Route::get('/item', [ItemController::class, 'index'])->name('item.index');
    Route::get('/addItem', [ItemController::class, 'create'])->name('item.add');
    Route::post('/itemAdd', [ItemController::class, 'store'])->name('item.store');
    Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::patch('/item/{item}', [ItemController::class, 'update'])->name('item.update');
    Route::post('/item/{item}', [ItemController::class, 'destroy'])->name('item.delete');

    Route::get('/refdate', [AuctionReferenceController::class, 'index'])->name('refdate.index');
    Route::post('/auctionReference', [AuctionReferenceController::class, 'store'])->name('auctionReference.store');
    Route::patch('/refdate/{id}', [AuctionReferenceController::class, 'update'])->name('refdate.update');
    Route::post('/refdate/{id}', [AuctionReferenceController::class, 'destroy'])->name('refdate.delete');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/user/{user}', [AdminUserController::class, 'destroy'])->name('user.delete');

    Route::get('/adminusers', [AdminUserController::class, 'adminUsers'])->name('adminusers.show');
    Route::post('/adminuser', [AdminUserController::class,  'store'])->name('adminuser.store');

    Route::get('/admin/recent-activities', [AdminController::class, 'getRecentActivities']);
    Route::get('/item/report', [AdminController::class, 'generateItemReport'])->name('item.report');
    Route::get('/item/report/generate-bulk', [AdminController::class, 'generateBulkItemReports'])->name('item.bulk.report');

});

Route::group(['namespace' => 'Item', 'middleware' => 'auth'],function() {
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payment.show');
    Route::get('/finalPayments', [AdminPaymentController::class, 'finalPayView'])->name('finalpayment.show');
    Route::get('/bids', [BidController::class, 'index'])->name('bid.index');
    // Route::get('/items/{refDate}', [BidController::class, 'getItemsByrefDate'])->name('items.getItemsByrefDate');
    Route::get('/rePayment', [AdminPaymentController::class, 'rePayView'])->name('repayment.show');
    // Route::patch('/repayment/{id}', [PaymentController::class, 'rePayment'])->name('payments.update');
    Route::patch('/repayments/{id}/update-refund-status', [AdminPaymentController::class, 'updateRefundStatus'])->name('update-refund-status');


});

Route::group(['namespace' => 'UserBid', 'middleware' => 'auth'], function() {
    // Route::get('/useritem', [UserBidController::class, 'index'])->name('item.bid');
    Route::post('/payment/{item_id}', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/finalpayment/{item_id}', [PaymentController::class, 'finalPayment'])->name('finalpayment.pay');
    Route::patch('/payment/{id}', [AdminPaymentController::class, 'update'])->name('payment.update');
    Route::patch('/finalpayment/{id}', [AdminPaymentController::class, 'finalPayUpdate'])->name('finalpayment.update');
    Route::get('/bid/{item}', [UserBidController::class, 'show'])->name('bid.show');
    Route::post('/bid', [UserBidController::class, 'store'])->name('bid.store');
});

Route::get('/get-gewogs/{dzongcode}', [DzongkhagController::class, 'getGewogs']);
Route::get('/get-villages/{gewogcode}', [DzongkhagController::class, 'getVillages']);
// In routes/web.php
Route::get('/items/{auction_reference_date}', [UserController::class, 'index'])->name('items.index');


require __DIR__.'/auth.php';
