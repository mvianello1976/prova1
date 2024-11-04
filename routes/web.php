<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::prefix('partners/onboarding')->as('partners.onboarding.')->group(function () {
        Route::get('/step-1', \App\Livewire\Partner\Pages\Onboarding\Step1::class)->name('step-1');
        Route::get('/step-2', \App\Livewire\Partner\Pages\Onboarding\Step2::class)->name('step-2');
        Route::get('/step-3', \App\Livewire\Partner\Pages\Onboarding\Step3::class)->name('step-3');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    //    'verified',
    'onboarding',
    'role:administrator|partner',
])->prefix('dashboard')->group(function () {
    Route::get('/', \App\Livewire\Partner\Pages\Dashboard::class)->name('dashboard');
    Route::as('product.')->prefix('products')->group(function () {
        Route::get('/create', function () {
            $product = auth()->user()->products()->create();

            return redirect()->route('product.create', $product->id);
        })->name('init.create');
        Route::get('/', \App\Livewire\Partner\Pages\Product\Index::class)->name('index');
        Route::get('/{product}/edit', \App\Livewire\Partner\Pages\Product\Create::class)->name('create');
    });
    Route::as('availabilities.')->prefix('availabilities')->group(function () {
        Route::get('/', \App\Livewire\Partner\Pages\Availability\Index::class)->name('index');
        Route::get('/create', function () {
            $availability = \App\Models\Availability::create();

            return redirect()->route('availabilities.create', $availability->id);
        })->name('init.create');
        Route::get('/{availability}', \App\Livewire\Partner\Pages\Availability\Show::class)->name('show');
        Route::get('/{availability}/edit', \App\Livewire\Partner\Pages\Availability\Create::class)->name('create');
    });
    Route::as('bookings.')->prefix('bookings')->group(function () {
        Route::as('management.')->prefix('management')->group(function () {
            Route::get('/', \App\Livewire\Partner\Pages\Booking\Management\Index::class)->name('index');
            Route::get('/{order}', \App\Livewire\Partner\Pages\Booking\Management\Show::class)->name('show');
        });
        Route::get('/history', \App\Livewire\Partner\Pages\Booking\History::class)->name('history');
        Route::get('/scanner', \App\Livewire\Partner\Pages\Booking\Scanner::class)->name('scanner');
    });
    Route::as('specials.')->prefix('specials')->group(function () {
        Route::get('/', \App\Livewire\Partner\Pages\Specials\Index::class)->name('index');
        Route::get('/create', function () {
            $special = \App\Models\Special::create();

            return redirect()->route('specials.create', $special->id);
        })->name('init.create');
        Route::get('/{special}/edit', \App\Livewire\Partner\Pages\Specials\Create::class)->name('create');
    });
    Route::as('coupons.')->prefix('coupons')->group(function () {
        Route::get('/', \App\Livewire\Partner\Pages\Coupons\Index::class)->name('index');
        Route::get('/create', function () {
            $coupon = \App\Models\Coupon::create();

            return redirect()->route('coupons.create', $coupon->id);
        })->name('init.create');
        Route::get('/{coupon}/edit', \App\Livewire\Partner\Pages\Coupons\Create::class)->name('create');
    });
    Route::as('partner.profile.')->prefix('profile')->group(function () {
        Route::get('/', \App\Livewire\Partner\Pages\Profile\Show::class)->name('show');
    });
});

Route::as('guest.')->group(function () {
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
        'onboarding',
        'role:client',
    ])->prefix('user')->group(function () {
        Route::as('profile.')->group(function () {
            Route::get('/profile', \App\Livewire\Guest\Pages\Profile\Show::class)->name('show');
        });
    });

    Route::get('/', \App\Livewire\Guest\Pages\Index::class)->name('index');
    Route::get('/search', \App\Livewire\Guest\Pages\Search::class)->name('search');
    Route::get('/favorites', \App\Livewire\Guest\Pages\Favorites::class)->name('favorites');
    Route::get('/gift-cards', \App\Livewire\Guest\Pages\GiftCards::class)->name('gift-cards');
    Route::get('/{destination:slug}/{product:slug}', \App\Livewire\Guest\Pages\Product\Show::class)->name('product.show');
    Route::get('/cart', \App\Livewire\Guest\Pages\Cart::class)->name('cart');
    Route::get('/checkout', \App\Livewire\Guest\Pages\Checkout::class)->name('checkout');
    Route::get('/orders/{order:uuid}/tickets', \App\Livewire\Guest\Pages\Tickets::class)->name('tickets');
});
