<?php

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

use Illuminate\Support\Facades\Artisan;

// Route::get('/symlink', function () {
//     $target = '/home/u1564948/donasi.lazassalaamtimika.org/storage/app/public';
//     $shortcut = '/home/u1564948/public_html/donasi/storage';
//     symlink($target, $shortcut);
//     Artisan::call('dump-autoload');
//     Artisan::call('cache:clear');
//     Artisan::call('route:clear');
//     Artisan::call('config:clear');
// });

Route::post('/payment_notification/{type}', 'PaymentController@paymentCallback');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::get('home', function () {
    $route = '/';
    if (auth()->check()) {
        if (auth()->user()->level == 'admin') {
            $route = '/admin';
        } else {
            $route = '/';
        }
    } else {
        $route = '/login';
    }
    return redirect($route);
});

Auth::routes(['verify' => true]);
Route::get('demo', function () {
    return view('auth.reset.mail');
});
Route::get('/forgot-password', 'Auth\ForgotPasswordController@viewForgot');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@actForgot');
Route::get('/forgot-success', 'Auth\ForgotPasswordController@viewSuccess');
Route::get('/reset-password', 'Auth\ForgotPasswordController@viewReset');
Route::post('/reset-password', 'Auth\ForgotPasswordController@doReset');

// Route::get('/invoice', 'InvoiceController@index');
Route::get('/invoice/view', 'InvoiceController@view');
Route::get('/invoice/{id}', 'InvoiceController@show');

Route::group(['middleware' => ['auth']], function () {

    # front page
    Route::group(['namespace' => 'Front'], function () {
        # my donations
        Route::get('/donation', 'DonationController@index');

        Route::get('/inbox', 'InboxController@index');
        Route::get('/account', 'AccountController@intro');
        Route::get('/my-account/edit', 'AccountController@edit');
        Route::post('/my-account/edit', 'AccountController@update');

        Route::get('/top_up', 'TopupController@index');
        Route::get('/top_up/nominal', 'TopupController@nominal');
        Route::post('/top_up/nominal', 'TopupController@save');
        Route::get('/top_up/payment', 'TopupController@choose_payment');
        Route::post('/top_up/payment', 'TopupController@payment');
        Route::get('/top_up/{id}', 'TopupController@detail');
        Route::get('/top_up/{id}/how_to_pay', 'TopupController@how_to_pay');
        Route::get('/top_up/{id}/proof', 'TopupController@proof');
        Route::post('/top_up/{id}/proof', 'TopupController@store_proof');
        Route::delete('/top_up/{id}/cancel', 'TopupController@cancel');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'is.role:admin', 'namespace' => 'Admin'], function () {
        # home
        Route::get('/', 'DashboardController@index');
        Route::post('/color', 'DashboardController@changeColor');
        Route::post('/logo', 'DashboardController@changeLogos');
        Route::get('/get-transaction', 'DashboardController@getTransaction'); // per week
        Route::get('/get-waiting', 'DashboardController@getWaiting'); // per week
        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@store');
        # slider
        Route::resource('/slider', 'SliderController', ['except' => ['show']]);
        # partner
        Route::resource('/partner', 'PartnerController', ['except' => ['show']]);
        # activity
        Route::resource('/activity', 'ActivityController', ['except' => ['show']]);
        # blog
        Route::resource('/blog', 'BlogController', ['except' => ['show']]);
        # category
        Route::resource('/category', 'CategoryController', ['except' => ['show']]);
        # blog category
        Route::resource('/blog-category', 'BlogCategoryController', ['except' => ['show']]);
        # ordering category
        Route::get('/category-ordering', 'CategoryController@order');
        Route::post('/category-ordering', 'CategoryController@saveOrder');
        # funding
        Route::resource('/funding', 'FundingController', ['except' => ['show']]);
        Route::post('/funding/data_index', 'FundingController@data_index');
        # donation
        Route::get('/donation', 'DonationController@index');
        Route::get('/donation/instant/{type}/{option?}', 'DonationController@instant')->where('type', 'sedekah|wakaf|zakat');
        Route::get('/donation/{id}/{option?}', 'DonationController@detail');
        # fundraiser
        Route::resource('/fundraiser', 'FundraiserController', ['except' => ['show']]);
        # campaign
        Route::resource('/campaign', 'CampaignController', ['except' => ['show']]);
        Route::post('/campaign/data_index', 'CampaignController@data_index');
        # wakaf
        Route::resource('/wakaf', 'WakafController', ['except' => 'show']);
        # zakat
        Route::resource('/zakat', 'ZakatController', ['except' => 'show']);
        # qurban
        Route::resource('/qurban', 'QurbanController', ['except' => 'show']);
        # registration
        Route::resource('/pendaftaran', 'RegistrationController', ['except' => 'show']);
        //archive
        Route::get('/archive', 'CampaignController@archive');
        Route::get('/archive/{id}/restore', 'CampaignController@restore');

        Route::get('/registration', 'RegistrationController@all');
        Route::get('/registration/export', 'RegistrationController@export');

        //generate kwitansi
        Route::get('/kwitansi/{id}', 'KwitansiController@show');

        //Route::post('/qurban/{id}', 'QurbanController@update');
        Route::post('/instant-program/{id}/switch', 'InstantProgramController@switch');
        Route::post('/instant-program', 'InstantProgramController@custom_nominal');

        # ordering project
        Route::get('/order', 'OrderController@index');
        Route::post('/order', 'OrderController@save');
        # pending
        Route::get('/pending', 'PendingController@index');
        Route::get('/pending/{id}', 'PendingController@show');
        Route::post('/pending/{id}/verify', 'PendingController@verify');
        # withdrawal
        Route::get('/withdrawal', 'WithdrawalController@index');
        Route::get('/withdrawal/{id}', 'WithdrawalController@show');
        Route::post('/withdrawal/{id}/verify', 'WithdrawalController@verify');
        Route::post('/withdrawal/{id}/reject', 'WithdrawalController@reject');
        # category
        Route::resource('/bank', 'BankController', ['except' => ['show']]);
        Route::get('/bank/activate', 'BankController@activate');
        # manual
        Route::get('/manual_donation/export', 'ManualDonationController@export');
        Route::resource('/manual_donation', 'ManualDonationController', ['except' => 'show']);
        Route::get('/manual_donation/{id}/receipt', 'ManualDonationController@receipt');
        # all
        Route::get('/all_donation', 'DonationController@all');
        Route::get('/all_donation/export', 'DonationController@export');
        Route::get('/all_donation/{id}', 'DonationController@show');
        Route::post('/all_donation/{id}/update', 'DonationController@update');
        Route::post('/all_donation/{id}/delete', 'DonationController@destroy');
        # not confirmed
        Route::get('/not_confirmed/payment_gateway', 'NotConfirmedController@payment_gateway');
        Route::get('/not_confirmed/manual', 'NotConfirmedController@manual');
        Route::get('/not_confirmed/{id}', 'NotConfirmedController@show');
        Route::post('/not_confirmed/{id}/verify', 'NotConfirmedController@verify');
        Route::post('/not_confirmed/{id}/update', 'NotConfirmedController@update');
        Route::post('/not_confirmed/{id}/delete', 'NotConfirmedController@destroy');
        Route::get('/not_confirmed/{type}/export', 'NotConfirmedController@export')->where('type', 'payment_gateway|manual');
        # payment_proof
        Route::get('/payment_proof', 'PaymentProofController@index');
        Route::get('/payment_proof/{id}', 'PaymentProofController@show');
        Route::post('/payment_proof/{id}/verify', 'PaymentProofController@verify');
        Route::post('/payment_proof/{id}/reject', 'PaymentProofController@reject');

        // qurban payment proof
        Route::get('/kurban_confirm', 'QurbanController@confirmation');
        Route::get('/kurban_proof/{id}', 'QurbanController@proof');
        Route::post('/kurban_proof/{id}/verify', 'QurbanController@verify');
        Route::post('/kurban_proof/{id}/reject', 'QurbanController@reject');

        # content
        Route::get('/content', 'ContentController@index');
        Route::post('/content', 'ContentController@store');

        # update
        Route::resource('/update', 'UpdateController', ['except' => ['show']]);

        Route::get('/notif', 'NotifController@index');
        Route::get('/notif/create', 'NotifController@create');
        Route::post('/notif', 'NotifController@store');
        Route::post('/notif/send', 'NotifController@send');

        Route::post('/mail_setting', 'ConfigController@mail_save');
        Route::get('/mail_setting', 'ConfigController@mail');

        Route::get('/kontak', 'KontakController@index');
        Route::get('/kontak/export', 'KontakController@export');

        Route::get('/topup', 'TopupController@index');
        Route::get('/topup/{id}', 'TopupController@proof');
        Route::post('/topup/{id}/verify', 'TopupController@verify');
        Route::post('/topup/{id}/reject', 'TopupController@reject');

        # setting
        Route::get('/google-analytics', 'SettingController@googleAnalytics');
        Route::post('/google-analytics', 'SettingController@saveGoogleAnalytics');
        // create route for /facebook-pixel
        Route::get('/facebook-pixel', 'SettingController@facebookPixel');
        // create route post for /facebook-pixel
        Route::post('/facebook-pixel', 'SettingController@saveFacebookPixel');
        Route::get('/google-font', 'SettingController@googleFont');
        Route::post('/google-font', 'SettingController@saveGoogleFont');

        Route::get('/payment-gateway', 'SettingController@paymentGateway');
        Route::post('/payment-gateway', 'SettingController@savePaymentGateway');

        Route::get('/setting', 'SettingController@index');
        Route::post('/setting', 'SettingController@save');

        # notification
        Route::get('/notification', 'NotificationController@index');
        Route::post('/notification', 'NotificationController@save');

        Route::post('/whatsapp', 'ConfigController@whatsapp_save');
        Route::get('/whatsapp', 'ConfigController@whatsapp');
        Route::post('/mediaberbagi', 'ConfigController@mediaberbagi_save');
        Route::get('/mediaberbagi', 'ConfigController@mediaberbagi');

        // Route::get('/notification', 'NotificationController@index');

        #product official store
        Route::resource('/product', 'ProductController');

        # funding distribution
        # distribution
        Route::resource('/funding_distribution', 'FundingDistributionController', ['except' => ['show']]);
        # instance right
        Route::get('/instance_right', 'FundingRightController@instance');
        Route::get('/mediaberbagi_right', 'FundingRightController@mediaberbagi');
        Route::get('/{right}/create', 'FundingRightController@create')->where('right', 'instance_right|mediaberbagi_right');
        Route::post('/{right}', 'FundingRightController@store')->where('right', 'instance_right|mediaberbagi_right');
        Route::get('/{right}/{id}/edit', 'FundingRightController@edit')->where('right', 'instance_right|mediaberbagi_right');
        Route::put('/{right}/{id}', 'FundingRightController@update')->where('right', 'instance_right|mediaberbagi_right');
        Route::delete('/{right}/{id}', 'FundingRightController@destroy')->where('right', 'instance_right|mediaberbagi_right');

        # donatur
        Route::get('/donatur/{status?}', 'DonaturController@byStatus');
        Route::get('/donatur/{status?}/export', 'DonaturController@export');

        # fundraiser
        Route::get('/fundraiser/leaderboard', 'FundraiserController@leaderboard');
        Route::get('/fundraiser/{type}/export', 'FundraiserController@export')->where('type', 'leaderboard');
        Route::get('/fundraiser/transaction', 'FundraiserController@transaction');
        Route::get('/fundraiser/transaction/{id}/detail', 'FundraiserController@showTransaction');
        Route::get('/fundraiser/transaction/verify/{id}', 'FundraiserController@verify');
        Route::get('/fundraiser/transaction/reject/{id}', 'FundraiserController@reject');

        # user
        Route::get('/user/create', 'UserController@create');
        Route::get('/user/{type?}', 'UserController@index');
        Route::post('/user', 'UserController@store');
        Route::get('/user/{id}/edit', 'UserController@edit');
        Route::put('/user/{id}', 'UserController@update');
        Route::delete('/user/{id}', 'UserController@destroy');


        # data usage
        Route::get('/data-usage', 'DataUsageController@index');

        Route::get('/update-software', 'UpdateSoftware@index');
        Route::get('/themes', 'ThemeController@index');
        Route::post('/themes', 'ThemeController@upload');

        // billing
        Route::get('/billing', 'BillingController@index');
        Route::post('/billing', 'BillingController@payment');
    });

    Route::group(['prefix' => 'fundraiser', 'middleware' => 'is.role:fundraiser', 'namespace' => 'Fundraiser'], function () {
        # home
        Route::get('/', 'DashboardController@index');
        # commission
        Route::get('/commission', 'CommissionController@index');
        # withdrawal
        Route::get('/withdrawal', 'WithdrawalController@index');
        Route::post('/withdrawal', 'WithdrawalController@store');
        # transaction
        Route::get('/transaction', 'TransactionController@index');

        # bank
        Route::get('/bank', 'WithdrawalController@bank');
        Route::post('/bank', 'WithdrawalController@bank_save');
        # profile
        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@update');
    });

    Route::group(['prefix' => 'accounting', 'middleware' => 'is.role:accounting', 'namespace' => 'Accounting'], function () {
        # home
        Route::get('/', 'DashboardController@index');

        # all
        Route::get('/all_donation', 'DonationController@all');
        Route::get('/all_donation/{id}', 'DonationController@show');
        Route::post('/all_donation/{id}/update', 'DonationController@update');
        Route::post('/all_donation/{id}/delete', 'DonationController@destroy');
        # not confirmed
        Route::get('/not_confirmed/payment_gateway', 'NotConfirmedController@payment_gateway');
        Route::get('/not_confirmed/manual', 'NotConfirmedController@manual');
        Route::get('/not_confirmed/{id}', 'NotConfirmedController@show');
        Route::post('/not_confirmed/{id}/verify', 'NotConfirmedController@verify');
        Route::post('/not_confirmed/{id}/update', 'NotConfirmedController@update');
        Route::post('/not_confirmed/{id}/delete', 'NotConfirmedController@destroy');
        # payment_proof
        Route::get('/payment_proof', 'PaymentProofController@index');
        Route::get('/payment_proof/{id}', 'PaymentProofController@show');
        Route::post('/payment_proof/{id}/verify', 'PaymentProofController@verify');
        Route::post('/payment_proof/{id}/reject', 'PaymentProofController@reject');
        # manual
        Route::resource('/manual_donation', 'ManualDonationController', ['except' => 'show']);
        Route::get('/manual_donation/{id}/receipt', 'ManualDonationController@receipt');

        # donation
        Route::get('/donation', 'DonationController@index');
        Route::get('/donation/{id}', 'DonationController@detail');

        # distribution
        Route::resource('/funding_distribution', 'DistributionController', ['except' => ['show']]);
        # instance right
        Route::get('/instance_right', 'FundingRightController@instance');
        Route::get('/mediaberbagi_right', 'FundingRightController@mediaberbagi');
        Route::get('/{right}/create', 'FundingRightController@create')->where('right', 'instance_right|mediaberbagi_right');
        Route::post('/{right}', 'FundingRightController@store')->where('right', 'instance_right|mediaberbagi_right');
        Route::get('/{right}/{id}/edit', 'FundingRightController@edit')->where('right', 'instance_right|mediaberbagi_right');
        Route::put('/{right}/{id}', 'FundingRightController@update')->where('right', 'instance_right|mediaberbagi_right');
        Route::delete('/{right}/{id}', 'FundingRightController@destroy')->where('right', 'instance_right|mediaberbagi_right');

        # withdrawal
        Route::get('/fundraiser/withdrawal', 'FundraiserController@withdrawal');

        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@store');
    });

    Route::group(['prefix' => 'dashboard-program', 'middleware' => 'is.role:program', 'namespace' => 'Program'], function () {
        # home
        Route::get('/', 'DashboardController@index');

        # campaign
        Route::resource('/campaign', 'CampaignController', ['except' => ['show']]);
        # wakaf
        Route::resource('/wakaf', 'WakafController', ['except' => 'show']);
        # zakat
        Route::resource('/zakat', 'ZakatController', ['except' => 'show']);

        # category
        Route::resource('/category', 'CategoryController', ['except' => ['show']]);
        # ordering category
        Route::get('/category-ordering', 'CategoryController@order');
        Route::post('/category-ordering', 'CategoryController@saveOrder');
        # ordering project
        Route::get('/order', 'OrderController@index');
        Route::post('/order', 'OrderController@save');

        # update
        Route::resource('/update', 'UpdateController', ['except' => ['show']]);
        # distribution
        Route::resource('/funding_distribution', 'DistributionController', ['except' => ['show']]);

        # donatur
        Route::get('/donatur/{status?}', 'DonaturController@byStatus');
        Route::get('/donatur/{status?}/export', 'DonaturController@export');

        # fundraiser
        Route::get('/fundraiser', 'FundraiserController@index');
        Route::get('/fundraiser/leaderboard', 'FundraiserController@leaderboard');

        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@store');
    });

    Route::group(['prefix' => 'gerai', 'middleware' => 'is.role:gerai', 'namespace' => 'Gerai'], function () {
        # home
        Route::get('/', 'DashboardController@index');

        // generate kwitansi
        Route::get('/kwitansi/{id}', 'KwitansiController@show');

        # manual
        Route::resource('/manual_donation', 'ManualDonationController', ['except' => 'show']);
        Route::get('/manual_donation/{id}/receipt', 'ManualDonationController@receipt');

        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@store');
    });
});

// Route::get('/faspay', 'FaspayController@index');

Route::group(['namespace' => 'Front'], function () {

    # front without login
    Route::get('/', 'HomeController@index')->middleware('referral.parser');
    Route::get('/my-account', 'AccountController@index');
    Route::get('/official-store', 'StoreController@index');

    # register as fundraiser
    Route::get('/fundraiser/register', 'NewFundraiserController@form');
    Route::post('/fundraiser/register', 'NewFundraiserController@register');

    # store
    Route::get('/cart', 'StoreController@cart');
    Route::get('/product/cart', 'StoreController@cart');
    Route::get('/product/{id}', 'StoreController@detail');
    Route::get('/product/cart/{id}/delete', 'StoreController@delete');

    # category
    Route::get('/categories', 'CategoryController@index');
    Route::get('/category/{id}', 'CategoryController@show');
    Route::post('/category/{id}', 'CategoryController@getProject');
    Route::get('/project/{id}/news', 'ProjectController@news');
    Route::post('/project/{id}/donation', 'ProjectController@donation');
    Route::get('/project/type/{type}', 'HomeController@perType');
    # program
    Route::get('/program', 'ProgramController@index');
    Route::get('/program/c/{id}', 'ProgramController@index');
    Route::get('/program/favourite', 'ProgramController@favourite');
    # blog
    Route::get('/blog', 'BlogController@index');
    Route::get('/blog/c/{id}', 'BlogController@category');
    Route::get('/blog/{id}', 'BlogController@detail');

    Route::get('/activity', 'ActivityController@index');

    # qurban
    Route::get('/qurban', 'QurbanController@index');
    Route::get('/qurban/{id}/nominal', 'QurbanController@nominal');
    Route::post('/qurban/{id}/nominal', 'QurbanController@nominal_process');
    Route::get('/qurban/{id}/payment', 'QurbanController@choose_payment');
    Route::post('/qurban/{id}/payment', 'QurbanController@payment');
    Route::get('/qurban/my-qurban', 'QurbanController@history');
    Route::get('/qurban/{id}/how_to_pay', 'QurbanController@how_to_pay');
    Route::get('/qurban/{id}/proof', 'QurbanController@proof');
    Route::post('/qurban/{id}/proof', 'QurbanController@proof_store');
    # search
    Route::get('/search', 'HomeController@search');
    # activity
    Route::get('/activity/{id}', 'ActivityController@detail');
    # donation
    Route::get('/donation/my-donation', 'DonationController@history');
    Route::get('/donation/detail', 'DonationController@detail');
    Route::get('/donation/export', 'DonationController@export');
    Route::get('/donation/{id}/all-donations', 'DonationController@all');
    # fundraiser
    Route::get('/fundraiser/{id}/all-fundraiser', 'FundraiserController@all');
    Route::get('/all_fundraiser/{id}', 'ZakatController@fundraiser');

    # payment
    Route::get('/payment/{id}/how_to_pay', 'PaymentController@how_to_pay');
    Route::get('/payment/{id}/proof', 'PaymentController@proof');
    Route::post('/payment/{id}/proof', 'PaymentController@store_proof');
    Route::get('/donation/{id}', 'DonationController@show');

    Route::get('/about-us', 'DocController@about_us');
    Route::get('/term-condition', 'DocController@term_condition');
    Route::get('/help', 'DocController@help');
    Route::get('/setting', 'DocController@setting');

    // NEW PAYMENT ROUTE
    Route::get('/nominal/{payload}', 'ProjectController@nominal'); // update must login
    Route::post('/nominal/{payload}', 'ProjectController@nominal_process'); // update must login
    Route::get('/payment/{payload}', 'ProjectController@payment'); // update must login
    Route::post('/payment/{payload}', 'ProjectController@payment_process'); // update must login
    Route::get('/kalkulator', 'ProjectController@calculator'); // update
    Route::get('/calculator', 'ProjectController@calculator'); // update
    Route::get('/favourite/{payload}', 'ProjectController@favourite')->middleware(['middleware' => 'auth']); // update must login

    # instant donation
    Route::get('/donate/{btoa}', 'ProjectController@instantDonate')->middleware('referral.parser');

    Route::get('/donation/{id}/certificate', 'DonationController@certificate');

    Route::get('/register/fundraiser', 'FundraiserController@index');
    Route::post('/register/fundraiser', 'FundraiserController@store');

    Route::get('/thank-you', function () {
        $data = new stdClass();
        $data->id = 1;
        return view('front.thanks', ['data' => $data]);
    });

    Route::get('/donationfas', 'DonationController@faspay');
    Route::get('/callback/faspay', 'DonationController@faspay');

    # project
    Route::get('/{slug}', 'ProjectController@index')->middleware('referral.parser');
    Route::get('/project/save/{id}', 'ProjectController@save');
    Route::get('/program/favourite/delete/{id}', 'ProjectController@delete');
});
