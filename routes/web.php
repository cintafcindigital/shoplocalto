<?php
use Illuminate\Http\Request;
use App\Mail\MailtrapExample;

if(env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}
/*if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}*/
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
    // symabolic storage folder
    Route::get('/foo',function(){
        Artisan::call('storage:link');
    });
    Route::get('/send-mail', function () {

    Mail::to('newuser@example.com')->send(new MailtrapExample()); 

    return 'A message has been sent to Mailtrap!';

});
    // Route::get('/', 'PageController@home');
    Route::get('/', 'FrontendController@home');
    Route::get('singleshop/{id}', 'FrontendController@singleshop');
    Route::get('locations/{id}','FrontendController@locationshops');
    /*Route::get('MB2020',function(){
        return view('mb2020');
    });
    Route::get('mb2020',function(){
        return view('mb2020');
    });*/
    // Route::get('/website/{slug}', 'PageController@planning_tools_pages');
    //// Vendor payment process.................................
    Route::get('/payment-lead-details/{vendor_id?}', 'PageController@payment_lead_details');
    Route::get('/payment-freelisting-details/{vendor_id?}', 'PageController@payment_freelisting_details');
    Route::get('/activate-now', 'PageController@payment_details'); //// For Leads......
    Route::get('/join-now', 'PageController@payment_details'); //// For Bulk......
    Route::get('/new-vendor', 'PageController@payment_details'); //// For Marketing......
    Route::get('/search-listing/{searchKey}', 'PageController@search_listing');
    Route::get('/get-search-listing/{searchKey}', 'PageController@get_search_listing');
    Route::get('/payment-packages', 'PageController@payment_packages');
    Route::post('/promocode-request', 'PageController@promocode_request');
    Route::get('/payment-page/{subs_id?}', 'PageController@payment_page');
    Route::post('/save-payment-method', 'PageController@save_payment_method');
    Route::post('/store-payment-method', 'PageController@store_payment_method');
    Route::get('/payment-thankyou', 'PageController@payment_thankyou');

    Auth::routes();
    // Route::get('/dashboard/{popup?}', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/profile_pic', 'HomeController@profile_pic');
    Route::post('/my_wedding_pic', 'HomeController@my_wedding_pic');
    Route::post('/get_venues_list', 'HomeController@get_venues_list');
    Route::post('/get_vendor_list', 'HomeController@get_vendor_list');
    Route::post('/all_vendor_list_search', 'HomeController@all_vendor_list_search');
    Route::post('/get_vendor_list_full', 'HomeController@get_vendor_list_full');
    Route::post('/save_my_wedding_data', 'HomeController@save_my_wedding_data');

    Route::get('tools/seating_chart', 'HomeController@seating_chart');
    Route::get('tools/chartGrid', 'HomeController@get_chartGrid');
    Route::post('tools/save_tabledata', 'HomeController@save_tabledata');
    Route::post('tools/remove_chart_table', 'HomeController@remove_chart_table');
    Route::post('tools/update_table_positions', 'HomeController@update_table_positions');
    Route::get('tools/edit_chart_table/{id}', 'HomeController@edit_chart_table');
    Route::post('tools/update_chart_table', 'HomeController@update_chart_table');
    Route::post('tools/update_chart_table_list', 'HomeController@update_chart_table_list');
    Route::post('tools/seat_arrangement', 'HomeController@seat_arrangement');
    Route::post('tools/seat_arrangement_delete', 'HomeController@seat_arrangement_delete');
    Route::get('tools/seating_list', 'HomeController@seating_list');
    Route::post('tools/seating_list_position', 'HomeController@seating_list_position');
    Route::get('tools/guestsCSV', 'HomeController@GuestsCSV_export');
    Route::post('tools/guestsimportCSV', 'HomeController@guestsimportCSV');
    Route::get('tools/chart_PDF', 'HomeController@get_chart_PDF');
    Route::get('tools/chart_list_PDF', 'HomeController@get_chartList_PDF');

    Route::get('tools/my-wedding', 'HomeController@index')->name('home');
    Route::get('tools/to-do-list', 'HomeController@to_do_list');
    Route::get('tools/todolist-task-details', 'HomeController@todolist_task_details');
    Route::post('tools/save_form_task', 'HomeController@save_form_task');
    Route::get('tools/todo-list-csv', 'HomeController@todo_list_csv');
    Route::get('tools/checklistprint', 'HomeController@get_ChecklistPrint');
    Route::get('tools/todo-list-remove/{idx}', 'HomeController@todolist_task_remove');

    Route::get('tools/vendors', 'HomeController@vendors');
    Route::get('tools/vendors-category', 'HomeController@vendors_category');
    Route::get('tools/remove-booked-vendor/{id}', 'HomeController@remove_booked_vendor');
    Route::post('tools/udpate_saved_vendor_data', 'HomeController@udpate_saved_vendor_data');
    Route::post('tools/udpate_todo_list', 'HomeController@udpate_todo_list');
    Route::get('tools/dresses', 'HomeController@get_dresses');
    // Route::get('tools/guests/{type?}', 'HomeController@get_guests');
    Route::get('tools/guests', 'HomeController@get_guests');
    Route::post('tools/add_guest', 'HomeController@add_guest');
    Route::post('tools/edit_guest', 'HomeController@edit_guest');
    Route::post('tools/add_group', 'HomeController@add_group');
    Route::post('tools/add_menus', 'HomeController@add_menus');
    Route::post('tools/add_lists', 'HomeController@add_lists');
    Route::get('tools/remove_group/{idx}', 'HomeController@remove_group');
    Route::get('tools/change_invitation_status/{idx}/{cStats}', 'HomeController@change_invitation_status');
    Route::get('tools/change_invitation_menus/{idx}/{menus}', 'HomeController@change_invitation_menus');
    Route::get('tools/createNewMenu/{idx}/{menu_name}', 'HomeController@createNewMenu');
    Route::get('tools/updateMenu/{idx}/{menu_name}/{old_menu_name}', 'HomeController@updateMenu');
    Route::get('tools/updateTable/{chartId}/{table_name}', 'HomeController@updateTable');
    Route::get('tools/change_invitation_tables/{invId}/{chartId}', 'HomeController@change_invitation_tables');
    Route::get('tools/remove_menus/{idx}/{menus}', 'HomeController@remove_menus');
    Route::get('tools/change_invitation_lists/{idx}/{lists}', 'HomeController@change_invitation_lists');
    Route::get('tools/createNewList/{idx}/{list_name}', 'HomeController@createNewList');
    Route::get('tools/updateList/{idx}/{list_name}/{old_list_name}', 'HomeController@updateList');
    Route::get('tools/remove_lists/{idx}/{lists}', 'HomeController@remove_lists');
    Route::post('tools/remove_guest', 'HomeController@remove_guest');
    Route::get('tools/guests/eventForm', 'HomeController@guest_eventForm');
    Route::post('tools/guests/add_event', 'HomeController@guest_add_event');
    Route::get('tools/guests/remove_event/{idx}', 'HomeController@guest_remove_event');
    Route::get('tools/guests/stats', 'HomeController@guest_stats');
    Route::get('tools/guests/download_guestList', 'HomeController@download_guestList');
    Route::post('tools/guests_companion_add_new', 'HomeController@guests_companion_add_new');
    Route::post('tools/guests_companion_remove', 'HomeController@guests_companion_remove');
    Route::post('tools/moveToGroups', 'HomeController@moveToGroups');
    Route::post('tools/moveToAttendance', 'HomeController@moveToAttendance');
    Route::post('tools/moveToMenus', 'HomeController@moveToMenus');
    Route::post('tools/moveToLists', 'HomeController@moveToLists');
    ////// Mail invitations of Guest List........
    Route::get('tools/guests/onlineInvitation', 'HomeController@guest_onlineInvitation');
    Route::get('tools/guests/requestRSVP', 'HomeController@guest_requestRSVP');
    Route::get('tools/guests/requestAddress', 'HomeController@guest_requestAddress');

    Route::get('tools/guests_old_page/{type?}', 'HomeController@guests_old_page');
    Route::get('tools/get_guestlist', 'HomeController@get_guestlist');
    Route::get('tools/getsingleguest', 'HomeController@getsingleguest');
    Route::post('tools/editguest_new', 'HomeController@editguest_new');
    // Route::get('tools/remove-guest/{id}', 'HomeController@remove_guest');
    Route::get('tools/guest-export', 'HomeController@guest_export');

    Route::post('tools/save_guest_data', 'HomeController@save_guest_data');
    Route::post('tools/save_guest_data_new', 'HomeController@save_guest_data_new');

    Route::post('tools/get_guest_data', 'HomeController@get_guest_data');
    Route::post('tools/searchguest', 'HomeController@searchguest');
    Route::post('tools/edit_guest_data', 'HomeController@edit_guest_data');
    Route::get('tools/budget', 'HomeController@budget');
    Route::get('tools/budget-payments', 'HomeController@budget_payments');
    Route::get('tools/budget-category/{cat_id}', 'HomeController@budget_category');
    Route::get('tools/remove-budget/{id}', 'HomeController@remove_budget');
    Route::post('tools/save_total_estimate_budget_data', 'HomeController@save_total_estimate_budget');
    Route::post('tools/save_budget_data', 'HomeController@save_budget_data');
    Route::post('tools/edit_budget_data', 'HomeController@edit_budget_data');
    Route::post('tools/add_budget_payment', 'HomeController@add_budget_payment');
    Route::get('tools/budget-export', 'HomeController@budget_export');
    Route::get('tools/budgetreport', 'HomeController@get_BudgetReport');
    Route::post('tools/shared/rate', 'HomeController@shareRatings');

    Route::get('tools/wedding-website', 'HomeController@wedding_website');
    Route::post('tools/save-wedding-website', 'HomeController@save_wedding_website');

    Route::get('tools/wedshoots', 'HomeController@wedshoots');
    Route::get('tools/wedshoots-settings', 'HomeController@wedshoots_settings');
    Route::post('tools/save-wedshoots-settings', 'HomeController@save_wedshoots_settings');
    Route::post('tools/upload_album_images', 'HomeController@upload_album_images');
    Route::post('tools/delete_album_images', 'HomeController@delete_album_images');
    Route::post('tools/save_album_image_note', 'HomeController@save_album_image_note');

    Route::post('save_user_task', 'HomeController@save_user_task');
    Route::post('booked_vendor', 'HomeController@booked_vendor');
    Route::post('add_vendor_to_task', 'HomeController@add_vendor_to_task');

    Route::get('user-settings', 'HomeController@user_settings');
    Route::post('save-user-settings', 'HomeController@save_user_settings');
    Route::get('account-settings', 'HomeController@account_settings');
    Route::post('save-account-settings', 'HomeController@save_account_settings');
    Route::get('send-verify-link', 'HomeController@send_verify_link');

    Route::get('users-mailbox/{type}', 'HomeController@users_mailbox');
    Route::get('users-mailbox/inbox/{id}', 'HomeController@users_mailbox_details');
    Route::get('users-mailbox/vendors/{id}', 'HomeController@users_mailbox_details');
    Route::get('users-mailbox/administrator/{id}', 'HomeController@users_mailbox_details');
    Route::post('users-mailbox/add-vendors', 'HomeController@users_add_vendors');
    Route::post('users-mailbox/add-userRating', 'HomeController@users_add_userRating');
    Route::post('users-mailbox/add-userPrice', 'HomeController@users_add_userPrice');
    Route::post('users-mailbox/add-userNote', 'HomeController@users_add_userNote');
    Route::post('users-mailbox/add-vendor-to-profile', 'HomeController@add_vendor_to_profile');
    Route::post('users-mailbox/reply-fileupload/', 'HomeController@replyFileupload');
    Route::post('users-mailbox/reply/', 'HomeController@messageReplysend');
    Route::post('delete-mailinbox', 'HomeController@delete_mailbox');
    // Route::post('mailbox-send', 'HomeController@mailbox_send');

    Route::get('/testimonial', 'PageController@testimonial');
    Route::get('/add-testimonial', 'PageController@testimonialAdd');
    Route::post('/add-testimonial', 'PageController@testimonialAddSave');
    Route::get('/privacy-policy', 'PageController@terms');
    Route::get('/contact', 'PageController@contact'); 

    Route::post('/send-enquiry', 'PageController@sendEnquiry');

    Route::post('/request-enquiry', 'PageController@sendRequestEnquiry');
    Route::post('/page-request-enquiry', 'PageController@pageSendRequestEnquiry');

    Route::post('/save_newsletter', 'PageController@save_newsletter');
    Route::post('/save-review', 'PageController@save_review');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
    Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

    Route::get('login/google', 'Auth\LoginController@redirectToProviderGoogle');
    Route::get('login/google/callback', 'Auth\LoginController@handleProviderGoogleCallback');

    /* Community routes */
    /*Route::get('/community', 'Community\CommunityController@index');
    // Route::get('/community/search/{vals}', 'Community\CommunityController@get_search_community');
    Route::get('/community/{slug}', 'Community\CommunityController@community_groups');
    Route::get('/community/join-leave-group/{group_id}', 'Community\CommunityController@join_leave_group');
    Route::get('/community/join-login-check/{group_id}', 'Community\CommunityController@join_login_check');
    Route::post('/community/create-discussion', 'Community\CommunityController@create_discussion');

    Route::get('/forums', 'Community\CommunityController@community_forums');
    Route::get('/photos', 'Community\CommunityController@community_photos');
    Route::get('/videos', 'Community\CommunityController@community_videos');

    Route::get('/community/{slug}/forums', 'Community\CommunityController@all_discussion');
    Route::get('/community/{slug}/photos', 'Community\CommunityController@all_photos');
    Route::get('/community/{slug}/videos', 'Community\CommunityController@all_videos');
    Route::get('/community/{slug}/members', 'Community\CommunityController@all_members');

    Route::post('/community/post-group-videos', 'Community\CommunityController@add_group_videos');
    Route::post('/community/post-group-images', 'Community\CommunityController@add_group_images');

    Route::get('/community/forums/{slug}', 'Community\CommunityController@get_discussion_data');
    Route::post('/community/add-discussion-conmment', 'Community\CommunityController@add_discussion_comment');

    Route::get('/guest-account-verify/{id}', 'PageController@guest_account_verify');
    Route::post('/post-guest-account-verify', 'PageController@post_guest_account_verify');

    /* Wedding Ideas Routes */
    // Route::get('wedding-ideas', 'Weddingideas\WeddingideasController@index');
    // Route::get('blogs', 'Weddingideas\WeddingideasController@index');
    // Route::get('wedding-ideas/search/{search}', 'Weddingideas\WeddingideasController@get_search');
    // Route::get('blogs/search/{search}', 'Weddingideas\WeddingideasController@get_search');
    // Route::get('/community/search/{search}', 'Weddingideas\WeddingideasController@get_search');
    // Route::get('wedding-ideas/{slug}', 'Weddingideas\WeddingideasController@getweddingideasMainCategory');
    // Route::get('blogs/{slug}', 'Weddingideas\WeddingideasController@getweddingideasMainCategory');
    // Route::get('community/{slug}', 'Weddingideas\WeddingideasController@getweddingideasMainCategory');
    // Route::get('wedding-ideas/{mainslug}/{subslug}', 'Weddingideas\WeddingideasController@getweddingideasSubCategory');
    // Route::get('blogs/{mainslug}/{subslug}', 'Weddingideas\WeddingideasController@getweddingideasSubCategory');
    // Route::get('community/{mainslug}/{subslug}', 'Weddingideas\WeddingideasController@getweddingideasSubCategory');
    // Route::get('wedding-ideas-post/{slug}', 'Weddingideas\WeddingideasController@get_weddingIdeaspost');
    // Route::get('blog-posts/{slug}', 'Weddingideas\WeddingideasController@get_weddingIdeaspost');*/

    /*Blog Posts*/
    Route::get('blogs','BlogController@index');
    Route::get('blog','BlogController@index');
    Route::get('blogs/{cat_slug}','BlogController@index');
    Route::get('blog/{cat_slug}','BlogController@index');
    Route::get('blog-single/{slug}','BlogController@singleView');

    /*Community Section*/
    Route::get('community', 'BlogController@withVendors');
    Route::get('community/{cat_slug}', 'BlogController@withVendors');
    Route::get('community-post/{slug}', 'Weddingideas\WeddingideasController@get_weddingIdeaspost');
    Route::get('community-post/{slug}', 'BlogController@singleViewCommunity');
    Route::post('community-post/{slug}', 'BlogController@communityComments');

    /* Wedding Dresses Routes */
    // Route::get('wedding-dress', 'Weddingdresses\WeddingdressesController@index');
    // Route::get('wedding-dress/{d_slug}', 'Weddingdresses\WeddingdressesController@get_wedding_designers');
    // Route::get('wedding-dress/{d_slug}/{p_slug}', 'Weddingdresses\WeddingdressesController@get_wedding_designers_product');
    // Route::get('wedding-dress-all-designers', 'Weddingdresses\WeddingdressesController@all_designers');

    // Route::get('party-dresses', 'Weddingdresses\WeddingdressesController@party_index');
    // Route::get('party-dresses/{d_slug}', 'Weddingdresses\WeddingdressesController@get_party_designers');
    // Route::get('party-dresses/{d_slug}/{p_slug}', 'Weddingdresses\WeddingdressesController@get_party_designers_product');
    // Route::get('party-dresses-all-designers', 'Weddingdresses\WeddingdressesController@all_designers');

    Route::get('add-to-quiz/{quizArr}/{idx}', 'Weddingdresses\WeddingdressesController@add_to_quiz');
    Route::get('remove-to-quiz/{quizArr}/{idx}', 'Weddingdresses\WeddingdressesController@remove_to_quiz');
    Route::get('search-filters/{quizArr}', 'Weddingdresses\WeddingdressesController@get_search_filters');
    Route::get('add-to-favourites/{idx}', 'Weddingdresses\WeddingdressesController@add_to_favourites');

/*
|--------------------------------------------------------------------------
| Vendor Routes
|--------------------------------------------------------------------------
| Here is where you can register admin routes for your application.
*/
    Route::get('view_storefront/{id}', 'StorefrontController@index');
    Route::get('view_storefront/{id}/faqs', 'StorefrontController@index');
    Route::get('view_storefront/{id}/photos', 'StorefrontController@index');
    Route::get('view_storefront/{id}/videos', 'StorefrontController@index');
    Route::get('view_storefront/{id}/deals', 'StorefrontController@index');
    Route::get('view_storefront/{id}/map', 'StorefrontController@index');
    Route::get('view_storefront/{id}/promotions/{name}', 'StorefrontController@index');

    Route::get('/wedding-vendors/{cat_slug}/{venues_slug?}/faqs', 'PageController@getVenuesDetails');
    Route::get('/wedding-vendors/{cat_slug}/{venues_slug?}/photos', 'PageController@getVenuesDetails');
    Route::get('/wedding-vendors/{cat_slug}/{venues_slug?}/videos', 'PageController@getVenuesDetails');
    Route::get('/wedding-vendors/{cat_slug}/{venues_slug?}/deals', 'PageController@getVenuesDetails');
    Route::get('/wedding-vendors/{cat_slug}/{venues_slug?}/map', 'PageController@getVenuesDetails');
    Route::get('/wedding-vendors/{cat_slug}/{venues_slug?}/promotions/{name}', 'PageController@getVenuesDetails');

    Route::get('category/{slug?}','PageController@category_view')->name('category_view');

    Route::prefix('emp-vendor')->group(function(){
        
        // Route::get('/dashboard', 'VendorController@index')->name('vendor.dashboard');
    });
    /*Storefont View */
    // Route::prefix('emp-vendor')->group(function()
    // {
        Route::get('/login','Auth\VendorLoginController@viewLogin')->name('vendor.login');
        Route::post('/login', 'Auth\VendorLoginController@login')->name('vendor.login.submit');
        Route::get('password/reset', 'Auth\VendorForgotPasswordController@showLinkRequestForm');
        Route::post('password/email', 'Auth\VendorForgotPasswordController@sendResetLinkEmail');
        Route::get('password/reset/{token}', 'Auth\VendorResetPasswordController@showResetForm');
        Route::post('password/reset', 'Auth\VendorResetPasswordController@reset');
        Route::get('logout/', 'Auth\VendorLoginController@logout')->name('vendor.logout');

        // Route::get('/', 'VendorController@index')->name('vendor.dashboard');
        Route::get('/dashboard', 'VendorController@index')->name('vendor.dashboard');
        Route::get('/vendor-checklist', 'VendorController@vendorChecklist')->name('vendor.vendorChecklist');

        Route::get('/register', 'Auth\VendorLoginController@viewRegister');
        Route::get('/register-complete', 'Auth\VendorLoginController@registerComplete');
        Route::get('/search-citytown/{province}/{vals}', 'PageController@get_city_town');
        Route::post('/register', 'Auth\VendorLoginController@makeRegister');
        Route::get('/register-step-2', 'Auth\VendorLoginController@makeRegisterSecondStep');
        Route::post('/register-step-3', 'Auth\VendorLoginController@makeRegisterThiredStep');
        Route::get('/register-step-4', 'Auth\VendorLoginController@makeRegisterFourStepSimple');
        Route::post('/register-step-4', 'Auth\VendorLoginController@makeRegisterFourStep');

        Route::post('/upload_images', 'Auth\VendorLoginController@uploadImages');
        Route::get('vendor-settings', 'VendorController@vendor_settings');
        Route::post('save-vendor-settings', 'VendorController@save_vendor_settings');

        Route::get('profile-settings', 'VendorController@profile_settings');
        Route::post('save-profile-settings', 'VendorController@save_profile_settings');

        Route::get('account-settings', 'VendorController@account_settings');
        Route::post('save-account-settings', 'VendorController@save_account_settings');
        Route::get('image-settings', 'VendorController@image_settings');
        Route::post('upload_vendor_images', 'VendorController@uploadVendorImages');
        Route::post('delete_vendor_images', 'VendorController@delete_vendor_images');
        Route::post('set_as_profile_image', 'VendorController@set_as_profile_image');
        Route::get('discount-settings', 'VendorController@discount_settings');
        Route::post('save-discount-settings', 'VendorController@save_discount_settings');
        Route::post('update_vendor_questions', 'VendorController@update_vendor_questions');
        Route::get('question-settings', 'VendorController@question_settings');

        // New Routs with new design
        Route::get('/storefront', 'VendorController@get_storefront');
        Route::post('/storefront', 'VendorController@saveBusinessInfo');
        Route::get('/autocomplete_ajax', 'VendorController@autocompleteAjax');
        Route::get('/autocomplete_latlong', 'VendorController@autocomplete_latlong');

        // Billing All pages
        Route::get('/invoices', 'VbillingController@get_invoices');
        Route::get('/download-invoice/{id}', 'VbillingController@download_invoice');
        Route::get('/bills', 'VbillingController@get_bills');
        Route::get('/payBy-card/{id}', 'VbillingController@payBy_card');
        Route::post('/payPayment', 'VbillingController@payPayment');
        Route::get('/payment-method', 'VbillingController@get_payment_method');
        Route::get('/add-payment-method', 'VbillingController@get_add_payment_method');
        Route::post('/check-card-number', 'VbillingController@check_card_number');
        Route::post('/save-payment-method', 'VbillingController@save_payment_method');
        Route::post('/update-payment-method', 'VbillingController@update_payment_method');
        Route::get('/featured','VbillingController@listFeaturedItems');
        Route::post('/featured','payment\PayPalPaymentController@featuredProfileRequest');
        Route::get('/featured/{featureId?}','VbillingController@listFeaturedItems')->name('featured.lists');

        // Setting Inner page
        Route::get('/employees', 'VemployeeController@index');
        Route::post('/add-employee', 'VemployeeController@add_employees');
        Route::post('/update-employee', 'VemployeeController@update_employees');

        // Storefront Inner Page
        Route::get('/storefront-map', 'VendorController@get_storefrontmap');
        Route::post('/storefront-map', 'VendorController@saveAddressInfo');
        Route::get('/storefront-faqs', 'VendorController@get_storefrontfaqs');

        Route::post('/storefront-faqs', 'VendorController@save_storefrontfaqs');
        Route::get('/promociones', 'VendorController@get_promociones');
        Route::post('/promociones', 'VendorController@save_promociones');
        Route::get('/promocionesnew', 'VendorController@get_promocionesnew');
        Route::post('/promocionesnew', 'VendorController@save_promocionesnew');
        Route::get('/promocionesedit/{id}', 'VendorController@get_promocionesedit');
        Route::post('/promocionesedit/{id}', 'VendorController@update_promociones');
        Route::get('/promodelete/{id}', 'VendorController@delete_promo');
        Route::get('/promoremovepromoimg/{id}', 'VendorController@remove_promo_img');

        // Gallery Page
        Route::get('/gallery', 'VendorController@get_gallery');
        Route::post('/gallery', 'VendorController@savePhotos');
        Route::get('/gallerydelete/{id}', 'VendorController@delete_gallery');

        // Video Page
        Route::get('/videos', 'VendorController@get_videos');
        Route::post('/videos', 'VendorController@saveVideo');
        Route::get('/edit_video/{id}', 'VendorController@edit_video');
        Route::post('/edit_video/{id}', 'VendorController@update_video');
        Route::get('/delete_video/{id}', 'VendorController@delete_video');

        // Availability Page .......... new Controller by SHYAM on 24-09-2019
        Route::get('/availability', 'VavailabilityController@get_availability');
        Route::post('/availabilitySetting', 'VavailabilityController@availabilitySetting');

        Route::get('/fetch_contacts/{bDate}/{search}', 'VavailabilityController@fetch_contacts');
        Route::post('/availability-save-events', 'VavailabilityController@save_events');
        Route::get('/availability-edit-events/{id}', 'VavailabilityController@edit_events');
        Route::get('/availability-delete-events/{id}', 'VavailabilityController@delete_events');
        Route::get('/availability-calendar-status/{cDate}/{actClass}', 'VavailabilityController@calendar_status');

        Route::get('/infoCalendar', 'VavailabilityController@get_infoCalendar');
        Route::get('/eventCaledar', 'VavailabilityController@get_eventCaledar');

        // Events page
        Route::get('/events', 'VendorController@get_events');

        // Add Events Page
        Route::get('/eventsnew', 'VendorController@get_eventsnew');
        Route::post('/eventsnew', 'VendorController@save_eventsnew');
        Route::get('/eventsedit/{id}', 'VendorController@edit_events');
        Route::post('/eventsedit/{id}', 'VendorController@update_eventsnew');
        Route::get('/event_remove_img/{id}', 'VendorController@event_remove_img');
        Route::get('/event_delete/{id}', 'VendorController@event_delete');

        // Meet The Team Page
        Route::get('/owners', 'VendorController@get_owners');

        // Add Team Member Page
        Route::get('/ownersnew', 'VendorController@get_ownersnew');
        Route::post('/ownersnew', 'VendorController@save_ownersnew');
        Route::get('/ownersedit/{id}', 'VendorController@edit_owner');
        Route::post('/ownersedit/{id}', 'VendorController@update_owner');
        Route::get('/ownersdelete/{id}', 'VendorController@delete_owner');

        // Social Media Page
        Route::get('/sociales', 'VendorController@get_sociales');
        // Route::post('/sociales', 'VendorController@save_social_media');
        Route::post('/sociales', 'VendorController@update_social_media');
        Route::post('/upload-vendor-images', 'VendorController@imagesForVendor');        

        // Vendor Message Controller Pages
        Route::get('/messages', 'VmessageController@index')->name('vendor.messages');
        Route::get('/message-details/{id}', 'VmessageController@messages_details')->name('vendor.messages');
        Route::post('/send-reply-message','VmessageController@send_reply_message');
        Route::post('delete-messages', 'VmessageController@delete_messages');
        Route::get('/messages-unread', 'VmessageController@get_unreadmsg');
        Route::get('/messages-read', 'VmessageController@get_readmsg');
        Route::get('/messages-pending', 'VmessageController@get_pendingmsg');
        Route::get('/messages-replied', 'VmessageController@get_repliedmsg');
        Route::get('/messages-booked', 'VmessageController@get_bookedmsg');
        Route::get('/messages-discarded', 'VmessageController@get_discardedmsg');
        Route::get('/entries', 'VmessageController@get_entries');
        Route::get('/messages-setting', 'VmessageController@get_msgsetting');
        Route::post('/messages-setting', 'VmessageController@post_msgsetting');
        Route::get('/messages-templates', 'VmessageController@get_msgtemplates');
        Route::post('/messages-templates', 'VmessageController@post_msgtemplates');
        Route::post('/update-messages-templates', 'VmessageController@update_msgtemplates');
        Route::get('/getmessage-templates/{id}', 'VmessageController@get_messageTemplate');
        Route::get('/delete-messages-templates/{id}', 'VmessageController@delete_messageTemplate');
        Route::post('/message-add-note', 'VmessageController@add_message_note');
        Route::post('/resend-lead', 'VmessageController@resend_lead');
        Route::get('/print-lead/{leadid}', 'VmessageController@get_print_leads');
        Route::post('/booking-status', 'VmessageController@booking_status');
        Route::post('/messages-status', 'VmessageController@messageStatus');
        Route::get('/messages-details-status/{eqid}/{status}', 'VmessageController@messageStatusdetails');
        Route::get('/messages-status-details/{eqid}/{status}', 'VmessageController@messageDetailsStatus');
        Route::post('/reply-fileupload/', 'VmessageController@replyFileupload');
        Route::get('/set-message-template/{id}', 'VmessageController@set_messageTemplate');
        Route::post('/leadexport', 'VmessageController@export');

        // Support - Ticket section BY SHYAM......
        Route::get('supports/opened', 'TicketController@tickets_opened');
        Route::get('supports/awaiting-replies', 'TicketController@tickets_awaiting');
        Route::get('supports/closed', 'TicketController@tickets_closed');
        Route::get('supports/customer-service', 'TicketController@tickets_customer');
        Route::get('supports/sales-support', 'TicketController@tickets_sales');
        Route::get('supports/technical-support', 'TicketController@tickets_technical');
        Route::get('supports-details/{id}', 'TicketController@supports_details');
        Route::post('supports-fileupload/', 'TicketController@supportsFileupload');
        Route::get('supports-status-details/{eqid}/{status}/{changeby}', 'TicketController@supportsStatusdetails');
        Route::get('supports-details-status/{eqid}/{status}', 'TicketController@supportsDetailsStatus');
        Route::post('send-reply-supports','TicketController@send_reply_supports');
        Route::get('ticket-support-add','TicketController@ticket_support_add');
        Route::post('/send-new-supports', 'TicketController@sendNewSupport');

        // Review Inner Page BY-SHYAM......
        Route::get('/reviews', 'VreviewController@index')->name('vendor.reviews');
        Route::get('/getTemplate/{id}', 'VreviewController@getTemplate');
        Route::get('/getSearchClients/{search}', 'VreviewController@getSearchClients');
        Route::get('/getSearchNameEmail/{search}', 'VreviewController@getSearchNameEmail');
        Route::get('/sendRequestAgain/{id}', 'VreviewController@sendRequestAgain');
        Route::get('/view_reviews/{id}', 'VreviewController@view_reviews');
        Route::post('/addProfilePicture', 'VreviewController@addProfilePicture');

        Route::post('/send-reviews-request', 'VreviewController@send_reviews_request');

        Route::post('delete-review', 'VreviewController@delete_review');
        Route::get('/review-status/{id}/{status}', 'VreviewController@review_status');

        Route::get('/reviews-list', 'VreviewController@get_reviewlist');
        Route::get('/highlight_reviews/{id}', 'VreviewController@highlight_reviews');
        Route::get('/review-dispute/{id}', 'VreviewController@reviewDispute');
        Route::post('/save-review-dispute', 'VreviewController@saveReviewDispute');

        Route::get('/reviews-sellos', 'VreviewController@get_reviewsellos');
        Route::get('/reviews-widget', 'VreviewController@get_reviewwidget');
        Route::get('/reviews-templates', 'VreviewController@get_reviewtemplate');
        Route::post('/addTemplate', 'VreviewController@addTemplate');
        Route::get('/editTemplate/{id}', 'VreviewController@editTemplate');
        Route::post('/editTemplateSave', 'VreviewController@editTemplateSave');
        Route::post('/saveReviewReply', 'VreviewController@saveReviewReply');

        // Wedding Ideas Route
        // Route::get('/wedding-ideas', 'VweddingideasController@index');
        Route::get('/blogs', 'VreviewController@blogs');
        // Route::get('/add-wedding-ideas', 'VweddingideasController@add_weddingIdeas');
        Route::get('/add-blogs', 'VreviewController@addblogs');
        Route::post('/add-blogs', 'VreviewController@savePost');
        Route::get('/delete-blog/{id}', 'VreviewController@deleteBlog');
        Route::post('/save-wedding-ideas', 'VweddingideasController@save_weddingIdeas');
        Route::get('/edit-wedding-ideas/{id}', 'VweddingideasController@edit_weddingIdeas');
        Route::get('/delete-wedding-ideas/{id}', 'VweddingideasController@delete_weddingIdeas');
        Route::get('/getsubcategory/{id}', 'VweddingideasController@get_subcategory');

    // });
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Here is where you can register admin routes for your application.
*/
    Route::prefix('admin')->group(function()
    {
        Route::get('/', 'AdminController@index')->name('admin.dashboard');
        Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
        Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
        Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
        
        Route::get('get-vendors', 'AdminController@getVendors');
        Route::post('set-vendors', 'AdminController@setVendorHome');
        Route::get('remove-home-page-vendors/{id}', 'AdminController@removeVendorHome');
        
        Route::get('/pages/{search?}', 'AdminController@pages');
        Route::get('/add-page', 'AdminController@add_page');
        Route::post('/save_page', 'AdminController@save_page');
        Route::get('/edit-page/{id}', 'AdminController@edit_page');
        Route::get('/delete-page/{id}', 'AdminController@delete_page');
        Route::post('/update_page', 'AdminController@update_page');

        Route::get('/admin-testimonials', 'AdminController@testimonials');
        Route::get('/admin-add-testimonials', 'AdminController@add_testimonial');
        Route::post('/admin_save_testimonials', 'AdminController@save_testimonial');
        Route::get('/edit-testimonials/{id}', 'AdminController@edit_testimonial');
        Route::post('/save_changes_testimonial', 'AdminController@save_changes_testimonial');
        Route::delete('/delete_testimonial/{id}', 'AdminController@delete_testimonial');
        Route::get('/status-testimonial/{id}/{status}', 'AdminController@status_testimonial');

        Route::get('/add-slider', 'AdminController@add_slider');
        Route::post('/save_slider', 'AdminController@save_slider');
        Route::delete('/delete_slider/{id}', 'AdminController@delete_slider');
        //// Add Subscription here......
        Route::get('/subscription', 'AdminController@add_subscription');
        Route::post('/save_subscription', 'AdminController@save_subscription');
        Route::get('/edit-subscription/{id}', 'AdminController@edit_subscription');
        Route::post('/update_subscription', 'AdminController@update_subscription');
        Route::delete('/delete_subscription/{id}', 'AdminController@delete_subscription');
        // Route::get('/delete_subscription/{id}', 'AdminController@delete_subscription');

        Route::get('/categories/{search?}', 'AdminController@categories');
        Route::get('/add-category', 'AdminController@add_category');
        Route::post('/save_category', 'AdminController@save_category');
        Route::get('/edit-category/{id}', 'AdminController@edit_category');
        Route::get('/delete-category/{id}', 'AdminController@delete_category');
        Route::post('/edit_category_data', 'AdminController@edit_category_data');
        Route::get('/status-category/{id}/{status}', 'AdminController@status_category');

        Route::get('/admin-setting', 'AdminController@admin_setting');
        Route::get('/manage-admin', 'AdminController@manage_admin');
        Route::get('/edit-admin/{id}', 'AdminController@edit_admin');
        Route::post('/edit_admin_data', 'AdminController@edit_admin_data');

        Route::get('/company-settings', 'AdminController@company_settings');
        Route::get('/edit-company-settings/{id}', 'AdminController@edit_company_settings');
        Route::post('/edit_company_settings_data', 'AdminController@edit_company_settings_data');

        Route::get('/social-settings', 'AdminController@social_settings');
        Route::get('/edit-social-settings/{id}', 'AdminController@edit_social_settings');
        Route::post('/edit_social_settings_data', 'AdminController@edit_social_settings_data');
        Route::get('/status-social-settings/{id}/{status}', 'AdminController@status_social_settings');
        
        Route::get('/vendors/{search?}', 'AdminVendorController@vendors');
        Route::delete('/delete-vendors', 'AdminVendorController@deleteBulkVendors');
        // Route::get('/vendors/{type}', 'AdminVendorController@vendors');
        Route::get('/addvendors','AdminVendorController@addvendor');
        Route::post('/addvendors','AdminVendorController@savevendor');
        Route::get('/vendor-details/{id}', 'AdminVendorController@vendor_details');
        Route::get('/vendor-details/del/{id}', 'AdminVendorController@delvendor_details');
        Route::get('/edit-vendor/{id}', 'AdminVendorController@edit_vendors');
        Route::post('/update-vendor/{id}', 'AdminVendorController@edit_vendor_data');
        Route::get('/status-vendor/{id}/{status}', 'AdminVendorController@status_vendor');
        Route::get('/weddingidea-permission/{id}/{status}', 'AdminVendorController@weddingidea_permission');
        Route::get('/active-vendors', 'AdminVendorController@active_vendors');
        Route::get('/inactive-vendors', 'AdminVendorController@inactive_vendors');
        Route::get('/pending-vendors', 'AdminVendorController@pending_vendors');
        Route::get('/payment-data/{vendorId}', 'AdminVendorController@payment_data');
        Route::post('/payment-data-save', 'AdminVendorController@payment_data_save');
        Route::post('/change-featured-status', 'AdminVendorController@featured_status');
        //// freelisting..................... 
        Route::get('/freelisting-vendors', 'AdminVendorController@freelisting_vendors');
        Route::get('/freelisting-mail-template', 'AdminVendorController@freelisting_mail_template');
        Route::post('mailing-fileupload/', 'AdminVendorController@mailingFileupload');
        Route::get('mailing-fileremove/{imgName}', 'AdminVendorController@mailingFileremove');
        Route::post('/bulk-freelisting-vendor', 'AdminVendorController@bulk_freelisting_vendor');

        Route::get('/view-team-member/{id}', 'AdminVendorController@view_team_member');
        Route::post('/update-team-member/{id}', 'AdminVendorController@update_team_member');
        
        Route::get('/change-listing-status/{id}/{status}', 'AdminVendorController@change_listing_status');
        Route::get('/change-listing-status-2/{id}/{status}', 'AdminVendorController@change_listing_status2');
        Route::post('/payment-with-listing-status', 'AdminVendorController@payment_with_listing_status');

        Route::post('payment-to-vendor','payment\PayPalPaymentController@vendorPaymentFromAdmin');
        Route::get('payment-vendor-status/{vendor_id}/{subscription_id}/{amount}/{due_date}/{numLoops}/{pay_type}/{paymnt_id}','payment\PayPalPaymentController@vendorPaymentFromAdminStatus')->name('confirm-payment-admin-vendor');

        Route::post('/bulk_guest_vendor', 'AdminVendorController@bulk_guest_vendor'); //// Upload Bulk Vendors here......
        Route::get('/all-invoices', 'AdminVendorController@all_invoices');
        Route::get('/invoice-reminder/{id}', 'AdminVendorController@invoice_reminder');
        Route::get('/download-invoice/{id}/{vendorId}', 'AdminVendorController@download_invoice');
        Route::get('/unpaid_inactive_vendors', 'AdminVendorController@unpaid_inactive_vendors');

        Route::get('/users/{search?}', 'AdminUserController@users');
        Route::get('/user-details/{id}', 'AdminUserController@user_details');
        Route::get('/edit-user/{id}', 'AdminUserController@edit_user');
        Route::post('/edit_user_save', 'AdminUserController@edit_user_save');
        Route::get('/status-user/{id}/{status}', 'AdminUserController@status_user');

        Route::get('/staff/{search?}', 'AdminController@staff');
        Route::post('/staff', 'AdminController@postStaff');
        Route::get('/edit-staff/{id}', 'AdminController@editStaff');
        Route::post('/updateStaff', 'AdminController@updateStaff');
        Route::get('/staff-details/{id}', 'AdminController@staff_details');
        Route::get('/status-staff/{id}/{status}', 'AdminController@status_staff');
        Route::delete('/delete-staff/{id}', 'AdminController@delete_staff');

        Route::get('/faqs', 'AdminController@faqs');
        Route::get('/add-faq', 'AdminController@add_faq');
        Route::post('/save_faq', 'AdminController@save_faq');
        Route::get('/edit-faq/{id}', 'AdminController@edit_faq');
        Route::post('/edit_faq_data', 'AdminController@edit_faq_data');
        Route::delete('/delete_faq/{id}', 'AdminController@delete_faq');
        Route::get('/status-faq/{id}/{status}', 'AdminController@status_faq');
        
        Route::get('/signup-enquiry', 'AdminController@signup_enquiry');
        Route::get('/list-claim-enquiry', 'AdminController@listClaimEnquiry');
        Route::get('/delete-signup/{id}', 'AdminController@signup_delete');
        Route::get('/reply-signup/{id}', 'AdminController@signup_reply');
        Route::get('/signup-details/{id}', 'AdminController@signup_details');

        Route::get('/request-enquiry', 'AdminController@request_enquiry');
        Route::get('/contact-enquiry', 'AdminController@contact_enquiry');
        Route::get('/reply-enquiry/{id?}','AdminController@reply_enquiry');
        Route::post('/send-message','AdminController@send_reply_message');

        Route::get('/newsletter', 'AdminController@newsletter');
        Route::delete('/delete_newsletter/{id}', 'AdminController@delete_newsletter');
        Route::delete('/delete_enquiry/{id}', 'AdminController@delete_enquiry');

        Route::get('download-newsletter','AdminController@download_newsletter');

        Route::get('/questions', 'AdminFrequentlyQuestionsController@questions');
        Route::get('/add-questions', 'AdminFrequentlyQuestionsController@add_questions');
        Route::post('/save_questions', 'AdminFrequentlyQuestionsController@save_questions');
        Route::get('/add-to-category', 'AdminFrequentlyQuestionsController@add_to_category');
        Route::post('/add-to-category', 'AdminFrequentlyQuestionsController@save_to_category');
        Route::get('/edit-to-category/{id}', 'AdminFrequentlyQuestionsController@edit_to_category');
        Route::post('/edit-to-category', 'AdminFrequentlyQuestionsController@update_to_category');
        Route::delete('/delete_question/{id}', 'AdminFrequentlyQuestionsController@delete_question');
        Route::get('/status-question/{id}/{status}', 'AdminFrequentlyQuestionsController@status_question');

        Route::get('/wedding-stories', 'AdminController@wedding_stories');
        Route::get('/add-wedding-stories', 'AdminController@add_wedding_stories');
        Route::post('/save_wedding_stories', 'AdminController@save_wedding_stories');
        Route::get('/edit-wedding-stories/{id}', 'AdminController@edit_wedding_stories');
        Route::post('/edit_wedding_stories_data', 'AdminController@edit_wedding_stories_data');
        Route::delete('/delete_wedding_stories/{id}', 'AdminController@delete_wedding_stories');
        Route::get('/status-wedding-stories/{id}/{status}', 'AdminController@status_wedding_stories');

        // Support - Ticket section BY SHYAM......
        Route::get('new-tickets', 'AdminTicketController@new_tickets');
        Route::get('pending-tickets', 'AdminTicketController@pending_tickets');
        Route::get('closed-tickets', 'AdminTicketController@closed_tickets');
        Route::get('ticket-details/{id}', 'AdminTicketController@ticket_details');
        Route::get('dispute-review-status/{id}/{status}', 'AdminTicketController@dispute_review_status');
        Route::post('reply-fileupload/', 'AdminTicketController@replyFileupload');
        Route::post('send-reply-admin','AdminTicketController@send_reply_admin');
        Route::get('supports-status-details/{eqid}/{status}/{changeby}', 'AdminTicketController@supportsStatusdetails');

        /* Admin Reports Controller */
        Route::get('/couples-report', 'ReportsController@couples_report');
        Route::get('/vendors-report', 'ReportsController@vendors_report');
        Route::get('/sites-report', 'ReportsController@sites_report');

        /* Admin Community routes */
        // Route::get('/community', 'Community\AdminCommunityController@get_community_group_list');
        Route::get('/pending-community', 'Community\AdminCommunityController@pending_community_group_list');
        Route::get('/active-community', 'Community\AdminCommunityController@active_community_group_list');
        Route::get('/community', 'BlogPostController@get_vendor_post');
        Route::get('/community/{slug}', 'BlogPostController@get_vendor_post');
        Route::get('/community-comments', 'BlogPostController@get_post_comments');
        Route::get('/community-comments/{slug}', 'BlogPostController@get_post_comments');
        Route::get('/comment-approve/{id}/{status}', 'BlogPostController@approve_comments');
        Route::get('/delete-comment/{id}', 'BlogPostController@delete_comments');

        Route::get('/add-group-community', 'Community\AdminCommunityController@add_community_group');
        Route::post('/save-group-community', 'Community\AdminCommunityController@save_community');
        Route::get('/edit-group-community/{id}', 'Community\AdminCommunityController@edit_community_group');
        Route::post('/update-group-community', 'Community\AdminCommunityController@update_community_group');

        /* Admin Wedding Ideas routes */
        Route::get('/weddingideas', 'Weddingideas\AdminWeddingideasController@index');
        Route::get('/pending-weddingideas', 'Weddingideas\AdminWeddingideasController@pending_wedding_ideas');
        Route::get('/active-weddingideas', 'Weddingideas\AdminWeddingideasController@active_wedding_ideas');

        Route::get('/add-weddingideas', 'Weddingideas\AdminWeddingideasController@add_weddingideas');
        Route::post('/save-weddingideas', 'Weddingideas\AdminWeddingideasController@save_weddingideas');
        Route::get('/status-weddingideas/{id}/{status}', 'Weddingideas\AdminWeddingideasController@status_weddingideas');
        Route::get('/edit-weddingideas/{id}', 'Weddingideas\AdminWeddingideasController@edit_weddingideas');
        Route::post('/update-weddingideas', 'Weddingideas\AdminWeddingideasController@update_weddingideas');

        /* Admin Wedding Dress routes */
        Route::get('/weddingdress', 'Weddingdresses\AdminWeddingdressController@index');
        Route::get('/add-weddingdress-type', 'Weddingdresses\AdminWeddingdressController@add_weddingdress_type');
        Route::post('/save-weddingdress-type', 'Weddingdresses\AdminWeddingdressController@save_weddingdress_type');
        Route::get('/status-weddingdress/{id}/{status}', 'Weddingdresses\AdminWeddingdressController@status_weddingdress');
        Route::get('/edit-weddingdress/{id}', 'Weddingdresses\AdminWeddingdressController@edit_weddingdress');
        Route::post('/update-weddingdress', 'Weddingdresses\AdminWeddingdressController@update_weddingdress');
        Route::get('/delete-weddingdress/{id}', 'Weddingdresses\AdminWeddingdressController@delete_weddingdress');

        /* Admin Wedding Dress designer routes */
        Route::get('/weddingdress-designer', 'Weddingdresses\AdminWeddingdressController@get_designer');
        Route::get('/add-weddingdress-designer', 'Weddingdresses\AdminWeddingdressController@add_designer');
        Route::post('/save-weddingdress-designer', 'Weddingdresses\AdminWeddingdressController@save_weddingdress_designer');
        Route::get('/status-weddingdress-designer/{id}/{status}', 'Weddingdresses\AdminWeddingdressController@status_weddingdress_designer');
        Route::get('/edit-weddingdress-designer/{id}', 'Weddingdresses\AdminWeddingdressController@edit_weddingdress_designer');
        Route::post('/update-weddingdress-designer', 'Weddingdresses\AdminWeddingdressController@update_weddingdress_designer');
        Route::get('/delete-weddingdress-designer/{id}', 'Weddingdresses\AdminWeddingdressController@delete_weddingdress_designer');

        /* Admin Wedding Dress Collestion routes */
        Route::get('/weddingdress-collections', 'Weddingdresses\AdminWeddingdressController@get_collections');
        Route::get('/add-weddingdress-collections', 'Weddingdresses\AdminWeddingdressController@add_collections');
        Route::post('/save-weddingdress-collections', 'Weddingdresses\AdminWeddingdressController@save_weddingdress_collections');
        Route::get('/status-weddingdress-collections/{id}/{status}', 'Weddingdresses\AdminWeddingdressController@status_weddingdress_collections');
        Route::get('/edit-weddingdress-collections/{id}', 'Weddingdresses\AdminWeddingdressController@edit_weddingdress_collections');
        Route::post('/update-weddingdress-collections', 'Weddingdresses\AdminWeddingdressController@update_weddingdress_collections');

        /* Wedding Dress Products routes */
        Route::get('/weddingdress-products', 'Weddingdresses\AdminWeddingdressController@get_products');
        Route::get('/add-weddingdress-products', 'Weddingdresses\AdminWeddingdressController@add_products');
        Route::post('/save-weddingdress-products', 'Weddingdresses\AdminWeddingdressController@save_weddingdress_products');
        Route::get('/status-weddingdress-products/{id}/{status}', 'Weddingdresses\AdminWeddingdressController@status_weddingdress_products');
        Route::get('/edit-weddingdress-products/{id}', 'Weddingdresses\AdminWeddingdressController@edit_weddingdress_products');
        Route::post('/update-weddingdress-products', 'Weddingdresses\AdminWeddingdressController@update_weddingdress_products');
        Route::get('/delete-weddingdress-products/{id}', 'Weddingdresses\AdminWeddingdressController@delete_weddingdress_products');

        Route::get('/get-designer-ajax/{id}', 'Weddingdresses\AdminWeddingdressController@get_designerByajax');
        Route::get('/delete-productimages-ajax/{id}', 'Weddingdresses\AdminWeddingdressController@delete_productImages');

        Route::post('/search_vendorname','AdminVendorController@search_vendorname');

        /*Blog Category */
        Route::get('/blog-category','BlogCategoryController@index');
        Route::get('/add-blog-category','BlogCategoryController@addView');
        Route::get('/edit-blog-category/{id}','BlogCategoryController@editView');
        Route::post('/edit-blog-category/{id}','BlogCategoryController@updateCategory');
        Route::get('/delete-blog-category/{id}','BlogCategoryController@delete_category');
        Route::post('/add-blog-category','BlogCategoryController@saveCategory');
        Route::get('/status-blog-category/{id}/{status}','BlogCategoryController@changeStatus');

        /*Blog Posts */
        Route::get('/blog','BlogPostController@index');
        Route::get('/add-blog','BlogPostController@addPost');
        Route::post('/add-blog','BlogPostController@savePost');
        Route::get('/edit-blog/{id}','BlogPostController@editView');
        Route::post('/edit-blog/{id}','BlogPostController@updatePost');
        Route::get('/blog-approve/{id}/{status}','BlogPostController@approveBlog');
        Route::get('/blog-publish/{id}/{status}','BlogPostController@publishBlog');
        Route::get('/delete-blog/{id}','BlogPostController@deleteBlog');
        Route::get('/view-blog/{id}','BlogPostController@viewBlogPost');
        Route::get('/delete-blog-pdf/{id}', 'BlogPostController@deleteBlogPdf');

        /*Promo Code*/
        Route::get('promocodes','PromoCodeController@promocodes');
        Route::get('add-promocode','PromoCodeController@addCode');
        Route::post('add-promocode','PromoCodeController@savePromocode');
        
        /*Featured Profiles*/
        Route::get('featured-profiles','AdminFeaturedProfileController@listProfiles');
        Route::get('featured-profiles/add','AdminFeaturedProfileController@viewForm');
        Route::get('featured-profiles/edit/{id}','AdminFeaturedProfileController@viewForm');
        Route::get('featured-profiles/delete/{id}','AdminFeaturedProfileController@deleteProfile');
        Route::get('featured-profile-vendors','AdminFeaturedProfileController@getVendorProfiles');
        Route::post('featured-profiles/edit/{id}','AdminFeaturedProfileController@saveRequest');
        Route::get('featured-profiles/status/{id}/{status}','AdminFeaturedProfileController@changeStatus');
        Route::post('featured-profiles/add','AdminFeaturedProfileController@saveRequest');
        
        /* Import Vendors */
        Route::get('import-vendors','AdminVendorImport@importVendors');
        Route::post('import-vendors','AdminVendorImport@importVendorsData');
        Route::post('delete-random-images','AdminVendorImport@deleteRandomImages');
        Route::post('get-category-images','AdminVendorImport@getCategoryImages');
        Route::post('upload-random-images','AdminVendorImport@uploadRandomImages');

        Route::get('districts','AdminLocationController@districts');
        Route::get('communities','AdminLocationController@communities');
        Route::get('add-community','AdminLocationController@add_community');
        Route::post('add-community','AdminLocationController@save_community');
        Route::get('edit-community/{id}','AdminLocationController@edit_community');
        Route::post('edit-community/{id}','AdminLocationController@save_community');
        Route::get('delete-community/{id}','AdminLocationController@delete_community');
        Route::get('add-features','AdminFeatureController@features');
        Route::post('save_feature','AdminFeatureController@savefeatures');
        Route::get('edit-feature/{id}','AdminFeatureController@editfeature');
        Route::post('edit-feature/{id}','AdminFeatureController@savefeatures');
        Route::get('delete-feature/{id}','AdminFeatureController@deletefeature');
        Route::get('add-banner','AdminBannerController@banner');
        Route::post('save_banner','AdminBannerController@savebanner');
        Route::get('edit-banner/{id}','AdminBannerController@editbanner');
        Route::post('edit-banner/{id}','AdminBannerController@savebanner');
        Route::get('delete-banner/{id}','AdminBannerController@deletebanner');
        Route::get('search-location/{district}/{vals}', 'AdminVendorController@search_location');

        Route::get('manage-menus','AdminMenuController@index');
        Route::get('add-menu','AdminMenuController@addmenu');
        Route::post('add-menu','AdminMenuController@savemenu');
        Route::get('edit-menu/{id}','AdminMenuController@editmenu');
        Route::post('edit-menu/{id}','AdminMenuController@savemenu');
        Route::get('delete-menu/{id}','AdminMenuController@deletemenu');


        Route::get('subscribers','AdminSubscriberController@index');
        Route::get('site-settings','AdminSiteSettingsController@index');
        Route::get('events','AdminEventController@index');
    });
/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
| Here is where you can register admin routes for your application.
*/

    //Route::get('/search/{cat_slug}/{location?}', 'PageController@getVenuesSearch');
    
    Route::get('/email-unsubscribe/{email}', 'PageController@unsubscribeNewsletterEmail');
    Route::post('/address_verify', 'PageController@address_verify');
    Route::get('/search', 'PageController@search');
    Route::get('/search-string', 'PageController@searchString');
    Route::get('/services/{slug}/{cat_slug?}', 'PageController@getVenues');
    Route::get('/vendor/{business_slug}/{id?}', 'PageController@getSingleVendor');
    Route::post('/vendor/{business_slug}', 'PageController@claimYourListing');
    Route::get('/services/{slug}/{cat_slug}/{venues_slug?}', 'PageController@getVenuesDetails');
    Route::get('/services/{slug}/{cat_slug}/{venues_slug}/{idx?}', 'PageController@getVenuesDetails');

    Route::get('/autocomplete_latlong', 'PageController@autocomplete_latlong');
    Route::get('/autocomplete_latlong_2', 'PageController@autocomplete_latlong_by_slug');
    Route::post('wishlist/store','WishlistController@store');
    Route::post('wishlist/remove','WishlistController@remove');
    Route::get('web/{slug}','WeddingWebsiteController@index');
    Route::get('album/{slug}','WeddingWebsiteController@album');

    // Route::get('/search/{cat_slug}/{location?}', 'PageController@getVenuesSearch');
    // Route::get('/wedding-vendors/{cat_slug?}', 'PageController@getVenues');
    // Route::get('/wedding-venues/{cat_slug?}', 'PageController@getVenues');
    // Route::get('/brides/{cat_slug?}', 'PageController@getVenues');
    // Route::get('/grooms/{cat_slug?}', 'PageController@getVenues');
    // Route::get('/wedding-vendors/{cat_slug}/{venues_slug?}', 'PageController@getVenuesDetails');
    // Route::get('/wedding-venues/{cat_slug}/{venues_slug?}', 'PageController@getVenuesDetails');
    // Route::get('/wedding-venues/{cat_slug}/{venues_slug}/{idx?}', 'PageController@getVenuesDetails');
    // Route::get('/brides/{cat_slug}/{venues_slug?}', 'PageController@getVenuesDetails');
    // Route::get('/grooms/{cat_slug}/{venues_slug?}', 'PageController@getVenuesDetails');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application.
*/
    // api services for user module
    Route::get('api/csrf/{id}', 'API\UserAPIController@csrf')->name('api.csrf');
    Route::get('api/refresh-csrf/{id}', 'API\UserAPIController@refreshcsrf')->name('api.csrf');

    Route::post('api/usersignup', 'API\UserAPIController@usersignup');
    Route::post('api/userlogin', 'API\UserAPIController@login')->name('api.login');
    Route::get('api/userdata/{id}', 'API\UserAPIController@userdata');
    Route::post('api/userdata/profilepicture/', 'API\UserAPIController@userprofilePicture');
    Route::post('api/userdata/save-my-wedding-data/', 'API\UserAPIController@save_my_wedding_data');

    // User todo list
    Route::get('api/userdata/user-to-do-list/{id}', 'API\UserAPIController@userto_do_list');
    Route::post('api/userdata/todolist-task-details', 'API\UserAPIController@usertodolist_task_details');
    Route::post('api/userdata/udpate_todo_list', 'API\UserAPIController@udpate_todo_list');
    Route::post('api/userdata/save_todo_task', 'API\UserAPIController@usersave_todo_task');
    Route::post('api/userdata/add-vendor-to-todo-task', 'API\UserAPIController@useradd_vendor_to_todo_task');
    Route::post('api/userdata/add-budget-to-todo-task', 'API\UserAPIController@usersave_budget_data');

    // user vendor relations
    Route::post('api/userdata/user-vendors-category', 'API\UserAPIController@useradd_user_vendors_category');
    Route::post('api/userdata/udpate-saved-vendor-data', 'API\UserAPIController@userudpate_saved_vendor_data');
    Route::post('api/userdata/remove-booked-vendor', 'API\UserAPIController@userremove_booked_vendor');
    Route::post('api/userdata/save-review', 'API\UserAPIController@website_save_review');

    // User guest relations
    Route::get('api/userdata/get-guests/{id}', 'API\UserAPIController@userget_guests');
    Route::post('api/userdata/save-guest-data', 'API\UserAPIController@usersave_guest_data');
    Route::get('api/userdata/get-guest-data/{guestID}', 'API\UserAPIController@userget_guest_data_by_group');
    Route::post('api/userdata/edit-guest-data', 'API\UserAPIController@useredit_guest_data');
    Route::get('api/userdata/remove-guest/{userid}/{guestid}', 'API\UserAPIController@userremove_guest');

    // User Budget relations
    Route::get('api/userdata/budget/{userid}', 'API\UserAPIController@usershow_budget');
    Route::get('api/userdata/budget-payments/{userid}', 'API\UserAPIController@userbudget_payments');
    Route::get('api/userdata/budget-category/{userid}/{catid}', 'API\UserAPIController@userbudget_category');
    Route::post('api/userdata/save-total-estimate-budget_data', 'API\UserAPIController@usersave_total_estimate_budget');
    Route::post('api/userdata/save-budget-data', 'API\UserAPIController@usersave_budget_data');
    Route::post('api/userdata/edit-budget-data', 'API\UserAPIController@useredit_budget_data');
    Route::post('api/userdata/add-budget-payment', 'API\UserAPIController@useradd_budget_payment');
    Route::get('api/userdata/remove-budget/{budget_id}', 'API\UserAPIController@userremove_budget');

    // Wedding website relation
    Route::get('api/userdata/wedding-website/{userid}', 'API\UserAPIController@userwedding_website');
    Route::post('api/userdata/save-wedding-website', 'API\UserAPIController@usersave_wedding_website');

    // Webshoots relation
    Route::get('api/userdata/wedshoots/{userid}', 'API\UserAPIController@userwedshoots');
    Route::get('api/userdata/wedshoots-settings/{userid}', 'API\UserAPIController@userwedshoots_settings');
    Route::post('api/userdata/save-wedshoots-settings', 'API\UserAPIController@usersave_wedshoots_settings');
    Route::post('api/userdata/upload-album-images', 'API\UserAPIController@userupload_album_images');
    Route::get('api/userdata/delete-album-images/{useralbumphoto_id}', 'API\UserAPIController@userdelete_album_images');
    Route::post('api/userdata/save-album-image-note', 'API\UserAPIController@usersave_album_image_note');

    // User task panding Complete ajax
    Route::post('api/userdata/save-user-task', 'API\UserAPIController@ajax_save_user_task');

    // Booked vendor by user vender page
    Route::post('api/userdata/booked-vendor', 'API\UserAPIController@user_booked_vendor');

    // User Profile data API
    Route::get('api/userdata/user-settings/{user_id}', 'API\UserAPIController@user_profile_settings');
    Route::post('api/userdata/save-user-settings', 'API\UserAPIController@save_user_profile_settings');
    Route::post('api/userdata/save-account-settings', 'API\UserAPIController@save_account_password_settings');

    // Get user mailbox function
    Route::get('api/userdata/users-mailbox/{userid}/{type}', 'API\UserAPIController@get_users_mailbox');
    Route::get('api/userdata/users-mailbox/inbox/{userid}/{mailboxid}', 'API\UserAPIController@get_users_mailbox_details');
    Route::post('api/userdata/delete-mailinbox', 'API\UserAPIController@user_delete_mailbox');
    Route::post('api/userdata/mailbox-send', 'API\UserAPIController@user_mailbox_send');

    // common vendor request form for user and wesite
    Route::post('api/userdata/vender-request-enquiry', 'API\UserAPIController@user_vendorRequestEnquiry');
    Route::post('api/userdata/vendor-page-request-enquiry', 'API\UserAPIController@user_vendorRequestEnquiry');

    // Websites Routes
    Route::get('api/website/testimonial', 'API\WebsiteAPIController@website_testimonial');
    Route::get('api/website/terms', 'API\WebsiteAPIController@website_terms');
    Route::get('api/website/contact', 'API\WebsiteAPIController@website_contact');
    Route::post('api/website/save_newsletter', 'API\WebsiteAPIController@website_save_newsletter');
    Route::post('api/website/send-enquiry', 'API\WebsiteAPIController@website_sendEnquiry'); // website contact form (pedding)
    Route::get('api/website/vendor/{cat_id}', 'API\WebsiteAPIController@get_vendorBycategory');
    // api services for vendor module
    Route::get('api/vendors', 'API\VendorAPIController@index');
    /*Route::get('/clear-cache', function() {
        echo "string";
    $exitCode = Artisan::call('cache:clear');
        // return what you want
    });*/
    /*Route::get('test-email',function(){
        // phpinfo();
        // exit;
        Mail::send('emails.professional_tips',[
                        'roleType' => '',
                        'name' => @$this->objectData['name'],
                        'email' => @$this->objectData['email'],
                        'number_of_guests' => @$this->objectData['number_of_guests'],
                        'event_date' => @$this->objectData['event_date'],
                        'phone' => @$this->objectData['phone'],
                        'comment' => @$this->objectData['comment'],
                        'vendor_id' => @$this->companyData[0]->vendor_id,
                        'business_name' => @$this->companyData[0]->business_name,
                        'category_title' => @$this->companyData[0]->title,
                        'telephone' => @$this->companyData[0]->telephone,
                        'business_address' => @$this->companyData[0]->business_address,
                        'province' => @$this->companyData[0]->province,
                        'country' => @$this->companyData[0]->country,
                    ], function ($m) {
            $m->from('no-reply@myhealthsquad.ca', 'My Health Squad');
            $m->to('ashiqkmuhammed@gmail.com', 'Ashiq')->subject('New Member');
        });
        Mail::to('ashiqkmuhammed@gmail.com')->send(new VendorMakeChangesMail('ashiq'));
        return view('emails.blog_submission_french',[
                        'roleType' => '',
                        'name' => @$this->objectData['name'],
                        'email' => @$this->objectData['email'],
                        'number_of_guests' => @$this->objectData['number_of_guests'],
                        'event_date' => @$this->objectData['event_date'],
                        'phone' => @$this->objectData['phone'],
                        'comment' => @$this->objectData['comment'],
                        'vendor_id' => @$this->companyData[0]->vendor_id,
                        'business_name' => @$this->companyData[0]->business_name,
                        'category_title' => @$this->companyData[0]->title,
                        'telephone' => @$this->companyData[0]->telephone,
                        'business_address' => @$this->companyData[0]->business_address,
                        'province' => @$this->companyData[0]->province,
                        'country' => @$this->companyData[0]->country,
                    ]);
    });*/
    // Route::get('test-email','PageController@test_email');
    /*Route::get('destroy-all-session',function()
    {
        Session::flush();
    });*/
    /*use PayPal\Rest\ApiContext;
    use PayPal\Auth\OAuthTokenCredential;
    use PayPal\Api\Amount;
    use PayPal\Api\Details;
    use PayPal\Api\Item;
    use PayPal\Api\ItemList;
    use PayPal\Api\Payer;
    use PayPal\Api\Payment;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\PaymentExecution;
    use PayPal\Api\Transaction;
    use PayPal\Exception\PayPalConnectionException;
    Route::get('paypal-check',function()
    {
        $api_context = new ApiContext(
            new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret'))
        );
        $api_context->setConfig(config('paypal.settings'));
        $pay_amount = '10';
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item = new Item();
        $item->setName('Paypal Payment')->setCurrency('CAD')->setQuantity(1)->setPrice($pay_amount);
        $itemList = new ItemList();
        $itemList->setItems(array($item));
        $amount = new Amount();
        $amount->setCurrency('CAD')->setTotal($pay_amount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList)
        ->setDescription('Laravel Paypal Payment Tutorial');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('confirm-payment'))
        ->setCancelUrl(url()->current());
        $payment = new Payment();
        $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));
        try {
            $payment->create($api_context);
        } catch (PayPalConnectionException $ex){
            print_r($ex->getMessage());
            die;
            // return back()->withError('Some error occur, sorry for inconvenient');
        } catch (Exception $ex) {
            print_r($ex->getMessage());
            die;
            // return back()->withError('Some error occur, sorry for inconvenient');
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        if(isset($redirect_url)) {
            return redirect($redirect_url);
        }
        echo "some error";
    });*/
    // use Illuminate\Http\Request;
    /*Route::get('paypal-check-status',function(Request $request)
    {
       if (empty($request->query('paymentId')) || empty($request->query('PayerID')) || empty($request->query('token')))
            die('Payment was not successful.');
        $api_context = new ApiContext(
            new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret'))
        );
        $api_context->setConfig(config('paypal.settings'));
        $payment = Payment::get($request->query('paymentId'), $api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->query('PayerID'));
        $result = $payment->execute($execution, $api_context);
        if ($result->getState() != 'approved')
            die('Payment was not successful.');
        die('Payment made successfully');
    })->name('confirm-payment');*/
    /*Route::get('paypal-events',function(){
        // echo 'Some';
        // print_r($request->all());
        return view('emails.community_page_guidelines');
    });*/
    Route::post('make-payment','payment\PayPalPaymentController@request_payment');
    Route::get('make-payment/{subscription_id}','payment\PayPalPaymentController@payment_status')->name('confirm-payment');
    /*Route::get('execute-my-query',function(){
        \DB::select('ALTER TABLE `payment_methods` CHANGE `cardholder_name` `cardholder_name` VARCHAR(155) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `card_type` `card_type` VARCHAR(155) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `card_number` `card_number` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `card_cvc` `card_cvc` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `exp_month` `exp_month` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `exp_year` `exp_year` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL');
    });*/
    Route::get('bio/{slug}','PageController@bios');
    Route::get('about-us','PageController@aboutUs');
    Route::get('user-agreement','PageController@userAgreement');
    Route::get('community-guidelines','PageController@communityPage');
    Route::prefix('example')->group(function(){
        Route::get('/',function(){
            return redirect('/');
        });
        Route::get('blog/{page}','BlogController@blogExample');
        Route::get('vendor/{business_slug}','PageController@vendorExamples');
    });
    use Carbon\Carbon;
    use App\Vendor;
    use App\Mail\ProfessionalTipsLeadMail;
    use App\Mail\ProfessionalTipsMail;
    use App\Mail\BlogTipsMail;
    use App\Mail\NewBlogPublishResponderMail;
    use App\Mail\PromoteMemberOfTheWeek;
    Route::get('mail-auto-mhs-indigital-mailing-number-252-768-8521-XXX-9865',function(){
       /* Mail::raw('Text to e-mail', function ($message) {
            $message->from('no-reply@myhealthsquad.ca','My Health Squad');
            // $message->sender($address, $name = null);
            $message->to('ashiqindigital@gmail.com', 'ASHIQ');
            $message->subject('Randor TEST '.mt_rand(0,100));
            $message->attachData('Some DATA',null,[]);
        });*/
        $datetime = date('Y-m-d');
        $datetimeSave = date('Y-m-d H:i:s');
        $hour24 = DB::select("SELECT * FROM vendors WHERE DATE_FORMAT(created_at,'%Y-%m-%d') = STR_TO_DATE('$datetime','%Y-%m-%d') - INTERVAL 1 DAY AND vendor_id NOT IN (SELECT vendor_id FROM mail_send WHERE mail_after = 'hour24') AND verified = 1 AND status = 1");
        $hour120 = DB::select("SELECT * FROM vendors WHERE DATE_FORMAT(created_at,'%Y-%m-%d') = STR_TO_DATE('$datetime','%Y-%m-%d') - INTERVAL 5 DAY AND vendor_id NOT IN (SELECT vendor_id FROM mail_send WHERE mail_after = 'hour120') AND verified = 1 AND status = 1");
        $hour168 = DB::select("SELECT * FROM vendors WHERE DATE_FORMAT(created_at,'%Y-%m-%d') = STR_TO_DATE('$datetime','%Y-%m-%d') - INTERVAL 7 DAY AND vendor_id NOT IN (SELECT vendor_id FROM mail_send WHERE mail_after = 'hour168') AND verified = 1 AND status = 1");
        foreach ($hour24 as $key => $value) {
            Mail::to($value->email)->send(new ProfessionalTipsLeadMail($value->username,'','',$value->email));
            DB::table('mail_send')->insert(['vendor_id' => $value->vendor_id,'mail_after' => 'hour24','created_at' => $datetimeSave,'updatetd_at' => $datetimeSave]);
        }
        foreach ($hour120 as $key => $value) {
            Mail::to($value->email)->send(new ProfessionalTipsMail($value->username,'','',$value->email));
            DB::table('mail_send')->insert(['vendor_id' => $value->vendor_id,'mail_after' => 'hour120','created_at' => $datetimeSave,'updatetd_at' => $datetimeSave]);
        }
        foreach ($hour168 as $key => $value) {
            Mail::to($value->email)->send(new BlogTipsMail($value->username,'','',[],$value->email));
            DB::table('mail_send')->insert(['vendor_id' => $value->vendor_id,'mail_after' => 'hour168','created_at' => $datetimeSave,'updatetd_at' => $datetimeSave]);
        }
        /*$hour168 = DB::select("SELECT * FROM vendors WHERE vendors.freelisting = 'Yes' AND verified = 1 AND status = 1 AND vendor_id IN (SELECT vendor_id FROM mail_send WHERE mail_after = 'promote168' AND DATE_FORMAT(created_at,'%Y-%m-%d') = STR_TO_DATE('$datetime','%Y-%m-%d') - INTERVAL 7 DAY)");
        foreach ($hour168 as $key => $value) {
            Mail::to($value->email)->send(new PromoteMemberOfTheWeek($value->username,$value->email));
            DB::table('mail_send')->insert(['vendor_id' => $value->vendor_id,'mail_after' => 'promote168','created_at' => $datetimeSave,'updatetd_at' => $datetimeSave]);
        }*/
    });
    Route::get('get_phone_number','PageController@getPhoneNumber');
    Route::get('mail-trigger-once-every-week-0123658-445555-4555-41122166-XXXX-98',function(){
        /*$datetime = date('Y-m-d');
        $datetimeSave = date('Y-m-d H:i:s');
        $vendors = DB::select("SELECT vendors.* FROM vendors WHERE verified = 1 AND status = 1")->toArray();
        $vendorEmails = array_map(function($emails){
            return $emails->email;
        },$vendors);
        $blog168 = DB::select("SELECT * FROM blog_posts WHERE blog_posts.published = 1 AND blog_posts.approved = 1 AND blog_posts.id NOT IN (SELECT blog_id FROM mail_send WHERE mail_after = 'blog168') LIMIT 1");*/
        /*AND DATE_FORMAT(updatetd_at,'%Y-%m-%d') = STR_TO_DATE('$datetime','%Y-%m-%d') - INTERVAL 1 DAY*/
        /*AND blog_posts.created_at >= STR_TO_DATE('$datetime','%Y-%m-%d %H:%i:%s') - INTERVAL 7 DAY*/
        /*if(count($blog168) > 0)
        foreach ($vendors as $key => $value) {
            Mail::to($value->email)->send(new NewBlogPublishResponderMail($value->username,['email' => $value->email,'link' => url('blog-single/'.$blog168[0]->slug)]));
            DB::table('mail_send')->insert(['blog_id' => $value->vendor_id,'mail_after' => 'blog168','created_at' => $datetimeSave,'updatetd_at' => $datetimeSave]);
        }*/
    });
    /*Route::get('test-clear-view-cache',function(){
         Artisan::call('view:clear');
         Artisan::call('config:cache');
         Artisan::call('cache:clear');
    });*/

    Route::get('test-email-form',function(){
            /*    $vendorData = App\Vendor::leftJoin('vendor_companies as VC','VC.vendor_id','=','vendors.vendor_id')->select('vendors.*','VC.business_name','VC.business_address','VC.province','VC.country')->where('VC.id',11198)->where('vendors.status','1')->take(1)->get();
                $contactObj = App\ContactEnquiry::get()->first();
                foreach($vendorData as $vdt) {
                    $vendorEmail = $vdt->email;
                    if($vendorEmail != '') {
                        try {
                            return (new App\Mail\FreeListingEnquiry($vendorEmail,$vdt->business_name))->render();
                        } catch (\Exception $e) {
                            echo $e->getMessage();
                        }
                    }
                }*/
        $contactObj = App\ContactEnquiry::get()->first();
        $compayData = DB::select('SELECT V.vendor_id,V.username,V.telephone,V.email,V.message_notify_email,V.mobile,V.freelisting,V.cat_id,CT.title,VC.business_name,VC.business_address,VC.province,VC.country,VC.business_name_slug,vendor_images.vendor_folder,vendor_images.image from vendors AS V left join vendor_companies as VC ON V.vendor_id = VC.vendor_id left join categories as CT ON V.cat_id = CT.id left join (SELECT * FROM vendor_images GROUP BY vendor_id ORDER BY is_logo DESC) AS vendor_images ON V.vendor_id = vendor_images.vendor_id where VC.id = :id', ['id' => 11198]);
        $blogs = App\BlogPost::with('categories')->latest()->inRandomOrder()->limit(3)->get();
        return (new App\Mail\PatientAutoResponderMail($contactObj->name,$contactObj->email,$compayData[0],[],$blogs))->render();
    });