<?php

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardRendererController;
use App\Http\Controllers\Admin\AdminDashboardRendererController;
use App\Http\Controllers\HomeRendererController;
use App\Http\Controllers\Rider\RiderController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\TeamRendererController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Models\User;
use App\Models\GuestMessage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestMessageController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RiderManagementController;
use App\Http\Controllers\UserStatusController;
//=======================================
//Guest/Homepage Routes
//=======================================

Route::middleware('guest')->group(function () {

    // Route::get('/', function () {
    //     return view('home.home');
    // })->name('home');

    Route::get('/', [HomeRendererController::class, 'index'])
        ->name('home');

    Route::get('/about', [TeamRendererController::class, 'index'])
        ->name('about');

    Route::get('/blog', [BlogController::class, 'index'])
        ->name('blog');
    Route::get('/blogs/{id}', [BlogController::class, 'show'])
        ->name('blogs.show');

    Route::get('/service', function () {
        return view('home.service');
    })->name('service');

    Route::get('/vehicle', function () {
        return view('home.vehicle');
    })->name('vehicle');

    Route::get('/package', function () {
        return view('home.package');
    })->name('package');

    Route::get('/book-ride', function () {
        return view('home.book-ride');
    })->name('book-ride');

    Route::get('/buy-yencoin', function () {
        return view('home.buy-yencoin');
    })->name('buy-yencoin');

    Route::get('/contact-us', [GuestMessageController::class, 'create'])
        ->name('contact');

    Route::post('/contact-us', [GuestMessageController::class, 'store'])
        ->name('contact.store');

    Route::get('/testimonial', [TestimonialController::class, 'create'])
        ->name('testimonial.create');

    Route::post('/testimonial', [TestimonialController::class, 'store'])
        ->name('testimonial.store');
});



//===================================================
// Dashboard routes
//==================================================

// Auth middleware
Route::group(['middleware' => 'auth'], function () {

    //Main Redirect Controller
    // Route::resource('redirects', RedirectController::class, 
    // ['only' => 'index']);

    Route::get('redirects', [RedirectController::class, 'index'])
        ->name('user.redirect');

    // Audit Trail middleware
    Route::group(['middleware' => 'audit-trail'], function () {

        //========================================================
        // Rider
        //========================================================
        Route::group(['middleware' => 'rider'], function () {
            Route::prefix('rider')->group(function () {
                Route::name('rider.')->group(function () {

                    //view analytics page
                    Route::get('/dashboard', function () {
                        return view('rider.dashboard');
                    })
                        ->name('dashboard');

                    //dashboard:view
                    Route::get('/edit-profile', function () {
                        return view('rider.edit-profile');
                    })
                        ->name('edit-profile.edit');

                    //view upload page
                    Route::patch('/edit-profile', [ProfileController::class, 'update'])
                        ->name('edit-profile.update');

                    //change password:view
                    Route::get('/change-password', function () {
                        return view('rider.change-password');
                    })
                        ->name('change-password.edit');

                    //update password page
                    Route::patch('/change-password', [ChangePasswordController::class, 'updatePassword'])
                        ->name('change-password.update');
                });
            });
        });

        //========================================================
        // Driver
        //========================================================
        Route::group(['middleware' => 'driver'], function () {

            Route::prefix('driver')->group(function () {
                Route::name('driver.')->group(function () {

                    //dashboard:view
                    Route::get('/dashboard', [VehicleController::class, 'showAll'])
                        ->name('dashboard');

                    // Edit Profile
                    Route::get('/edit-profile', function () {
                        return view('driver.edit-profile');
                    })
                        ->name('edit-profile.edit');

                    //view upload page
                    Route::patch('/edit-profile', [ProfileController::class, 'update'])
                        ->name('edit-profile.update');

                    //change password:view
                    Route::get('/change-password', function () {
                        return view('driver.change-password');
                    })
                        ->name('change-password.edit');

                    //update password page
                    Route::patch('/change-password', [ChangePasswordController::class, 'updatePassword'])
                        ->name('change-password.update');

                    //Register vehicle
                    Route::get('/register-vehicle', [VehicleController::class, 'create'])
                        ->name('register-vehicle.create');

                    //Delete vehicle record
                    Route::delete('/dashboard/{vehicle}', [VehicleController::class, 'destroy'])
                        ->name('vehicle.destroy');
                });
            });
        });

        //========================================================
        // Admin
        //========================================================
        Route::group(['middleware' => 'admin'], function () {
            Route::prefix('admin')->group(function () {
                Route::name('admin.')->group(function () {

                    // landing
                    Route::get('/dashboard', [AdminDashboardRendererController::class, 'dashboardRenderer'])
                        ->name('dashboard');

                    // Edit Profile
                    Route::get('/edit-profile', function () {
                        return view('admin.edit-profile');
                    })
                        ->name('edit-profile.edit');

                    // view upload
                    Route::patch('/edit-profile', [ProfileController::class, 'update'])
                        ->name('edit-profile.update');

                    // change password
                    Route::get('/change-password', function () {
                        return view('admin.change-password');
                    })
                        ->name('change-password.edit');

                    // update password 
                    Route::patch('/change-password', [ChangePasswordController::class, 'updatePassword'])
                        ->name('change-password.update');

                    // audit trail
                    Route::get('/audit-trail', [AuditTrailController::class, 'index'])
                        ->name('audit-trail.index');

                    // show all guest messages
                    Route::get('/guest-msg', [GuestMessageController::class, 'index'])
                        ->name('guest-msg.index');

                    // read guest message
                    Route::get('/{message}/read-guest-msg', [GuestMessageController::class, 'show'])
                        ->name('guest-msg.show');

                    // delete guest message
                    Route::delete('/{message}/guest-msg', [GuestMessageController::class, 'destroy'])
                        ->name('guest-msg.destroy');

                    //Toggle betweeen Read and Not-Read
                    Route::put('/guest-msg/{message}/toggle', [GuestMessageController::class, 'toggleRead'])
                        ->name('guest-msg.toggle');

                    // Route to handle updating user status (ban, suspend, deactivate, activate)
                    Route::post('/users/{id}/update-status', [UserController::class, 'updateStatus'])
                        ->name('users.update-status');

                    // Display all testimonies
                    Route::get('/testimonial', [TestimonialController::class, 'adminIndex'])
                        ->name('testimonial');

                    // Display all testimonies
                    Route::get('/{testimonial}/read-testimony', [TestimonialController::class, 'show'])
                        ->name('testimonial.show');

                    // Approve and Disapprove testimonies
                    Route::put('/{testimonial}/toggle', [TestimonialController::class, 'toggleApprove'])
                        ->name('testimonial.toggle');

                    Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])
                        ->name('testimonial.destroy');

                    // Blog
                    Route::get('/blogs', [BlogController::class, 'adminIndex'])
                        ->name('blogs'); // View all blogs
                    Route::get('/create-blog', [BlogController::class, 'create'])
                        ->name('create-blog'); // Create form
                    Route::post('/blogs', [BlogController::class, 'store'])
                        ->name('blogs.store'); // Store blog
                    Route::get('/blogs/{id}', [BlogController::class, 'showAdmin'])
                        ->name('blogs.show'); // View blog
                    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])
                        ->name('blog-edit'); // update a blog posted
                    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])
                        ->name('blogs.destroy'); // delete a blog
                    Route::put('/blogs/{id}', [BlogController::class, 'update'])
                        ->name('blogs.update');
                    Route::get('/riders', [\App\Http\Controllers\Admin\RiderManagementController::class, 'index'])
                        ->name('riders.index');

                    Route::post('/riders/{rider}/update-status', [\App\Http\Controllers\Admin\RiderManagementController::class, 'updateStatus'])
                        ->name('riders.update-status');

                    Route::get('/riders/{rider}/rides', [\App\Http\Controllers\Admin\RiderManagementController::class, 'showRides'])
                        ->name('riders.show-rides');

                    Route::get('/riders/{rider}/confirm-status/{status}', [\App\Http\Controllers\Admin\RiderManagementController::class, 'confirmStatus'])
                        ->name('riders.confirm-status');


                    //  Route::get('/users/{user}/confirm-status/{status}', [UserStatusController::class, 'confirmStatusUpdate'])
                    // ->name('users.confirm-status');
                    //Route::post('/users/{user}/update-status', [UserStatusController::class, 'updateStatus'])
                    //  ->name('users.update-status');
                });
            });
        });
    });
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        // return view('redirects');
        return redirect()->route('user.redirect');
        // abort(403, 'Unauthorised action!');
    })->name('dashboard');
});
