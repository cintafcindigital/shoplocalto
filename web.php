<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
    // symabolic storage folder
    // Route::get('/foo', function () {
    //     Artisan::call('storage:link');
    // });
    Route::get('/', 'PageController@home');
        Route::get('MB2020',function(){
        return view('mb2020');
    });
    Route::get('mb2020',function(){
        return view('mb2020');
    });
    
    Route::get('/website/{slug}', 'PageController@planning_tools_pages');
    Route::get('/payment-page/{vendor_id}', 'PageController@payment_page');
    Route::post('/save-payment-method', 'PageController@save_payment_method');

    Auth::routes();
    Route::get('/dashboard/{popup?}', 'HomeController@index')->name('home');
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
    Route::get('/terms', 'PageController@terms');
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
    Route::get('/community', 'Community\CommunityController@index');
    Route::get('/community/search/{vals}', 'Community\CommunityController@get_search_community');
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
    Route::get('wedding-ideas', 'Weddingideas\WeddingideasController@index');
    Route::get('wedding-ideas/search/{search}', 'Weddingideas\WeddingideasController@get_search');
    Route::get('wedding-ideas/{slug}', 'Weddingideas\WeddingideasController@getweddingideasMainCategory');
    Route::get('wedding-ideas/{mainslug}/{subslug}', 'Weddingideas\WeddingideasController@getweddingideasSubCategory');
    Route::get('wedding-ideas-post/{slug}', 'Weddingideas\WeddingideasController@get_weddingIdeaspost');

    /* Wedding Dresses Routes */
    Route::get('wedding-dress', 'Weddingdresses\WeddingdressesController@index');
    Route::get('wedding-dress/{d_slug}', 'Weddingdresses\WeddingdressesController@get_wedding_designers');
    Route::get('wedding-dress/{d_slug}/{p_slug}', 'Weddingdresses\WeddingdressesController@get_wedding_designers_product');
    Route::get('wedding-dress-all-designers', 'Weddingdresses\WeddingdressesController@all_designers');

    Route::get('party-dresses', 'Weddingdresses\WeddingdressesController@party_index');
    Route::get('party-dresses/{d_slug}', 'Weddingdresses\WeddingdressesController@get_party_designers');
    Route::get('party-dresses/{d_slug}/{p_slug}', 'Weddingdresses\WeddingdressesController@get_party_designers_product');
    Route::get('party-dresses-all-designers', 'Weddingdresses\WeddingdressesController@all_designers');

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

    /*Storefont View */
    Route::prefix('emp-vendor')->group(function()
    {
        Route::get('/login','Auth\VendorLoginController@viewLogin')->name('vendor.login');
        Route::post('/login', 'Auth\VendorLoginController@login')->name('vendor.login.submit');
        Route::get('password/reset', 'Auth\VendorForgotPasswordController@showLinkRequestForm');
        Route::post('password/email', 'Auth\VendorForgotPasswordController@sendResetLinkEmail');
        Route::get('password/reset/{token}', 'Auth\VendorResetPasswordController@showResetForm');
        Route::post('password/reset', 'Auth\VendorResetPasswordController@reset');
        Route::get('logout/', 'Auth\VendorLoginController@logout')->name('vendor.logout');

        Route::get('/', 'VendorController@index')->name('vendor.dashboard');
        Route::get('/dashboard', 'VendorController@index')->name('vendor.dashboard');
        Route::get('/vendor-checklist', 'VendorController@vendorChecklist')->name('vendor.vendorChecklist');

        Route::get('/register', 'Auth\VendorLoginController@viewRegister');
        Route::get('/search-citytown/{province}/{vals}', 'Auth\VendorLoginController@get_city_town');
        Route::post('/register', 'Auth\VendorLoginController@makeRegister');
        Route::get('/register-step-2', 'Auth\VendorLoginController@makeRegisterSecondStep');
        Route::post('/register-step-3', 'Auth\VendorLoginController@makeRegisterThiredStep');
        Route::post('/register-step-4', 'Auth\VendorLoginController@makeRegisterFourStep');

        Route::post('/upload_images', 'Auth\VendorLoginController@uploadImages');
        Route::get('vendor-settings', 'VendorController@vendor_settings');
        Route::post('save-vendor-settings', 'VendorController@save_vendor_settings');
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
        Route::post('/sociales', 'VendorController@save_social_media');

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
        Route::get('/wedding-ideas', 'VweddingideasController@index');
        Route::get('/add-wedding-ideas', 'VweddingideasController@add_weddingIdeas');
        Route::post('/save-wedding-ideas', 'VweddingideasController@save_weddingIdeas');
        Route::get('/edit-wedding-ideas/{id}', 'VweddingideasController@edit_weddingIdeas');
        Route::get('/delete-wedding-ideas/{id}', 'VweddingideasController@delete_weddingIdeas');
        Route::get('/getsubcategory/{id}', 'VweddingideasController@get_subcategory');
    });
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Here is where you can register admin routes for your application.
*/
    Route::prefix('admin')->group(function()
    {
        Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
        Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
        Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

        Route::get('/add-slider', 'AdminController@add_slider');
        Route::post('/save_slider', 'AdminController@save_slider');
        Route::delete('/delete_slider/{id}', 'AdminController@delete_slider');

        Route::get('/pages/{search?}', 'AdminController@pages');
        Route::get('/add-page', 'AdminController@add_page');
        Route::post('/save_page', 'AdminController@save_page');
        Route::get('/edit-page/{id}', 'AdminController@edit_page');
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

        Route::get('/', 'AdminController@index')->name('admin.dashboard');

        Route::get('/categories/{search?}', 'AdminController@categories');
        Route::get('/add-category', 'AdminController@add_category');
        Route::post('/save_category', 'AdminController@save_category');
        Route::get('/edit-category/{id}', 'AdminController@edit_category');
        Route::post('/edit_category_data', 'AdminController@edit_category_data');
        Route::get('/status-category/{id}/{status}', 'AdminController@status_category');

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
        Route::get('/vendor-details/{id}', 'AdminVendorController@vendor_details');
        Route::get('/status-vendor/{id}/{status}', 'AdminVendorController@status_vendor');
        Route::get('/weddingidea-permission/{id}/{status}', 'AdminVendorController@weddingidea_permission');
        Route::get('/inactive-vendors', 'AdminVendorController@inactive_vendors');
        Route::post('/bulk_guest_vendor', 'AdminVendorController@bulk_guest_vendor');

        Route::get('/users/{search?}', 'AdminUserController@users');
        Route::get('/edit-user/{id}', 'AdminUserController@edit_user');
        Route::post('/edit_user_save', 'AdminUserController@edit_user_save');
        Route::get('/status-user/{id}/{status}', 'AdminUserController@status_user');

        Route::get('/faqs', 'AdminController@faqs');
        Route::get('/add-faq', 'AdminController@add_faq');
        Route::post('/save_faq', 'AdminController@save_faq');
        Route::get('/edit-faq/{id}', 'AdminController@edit_faq');
        Route::post('/edit_faq_data', 'AdminController@edit_faq_data');
        Route::delete('/delete_faq/{id}', 'AdminController@delete_faq');
        Route::get('/status-faq/{id}/{status}', 'AdminController@status_faq');

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

        /* Admin Community routes */
        Route::get('/community', 'Community\AdminCommunityController@get_community_group_list');
        Route::get('/add-group-community', 'Community\AdminCommunityController@add_community_group');
        Route::post('/save-group-community', 'Community\AdminCommunityController@save_community');
        Route::get('/edit-group-community/{id}', 'Community\AdminCommunityController@edit_community_group');
        Route::post('/update-group-community', 'Community\AdminCommunityController@update_community_group');

        /* Admin Wedding Ideas routes */
        Route::get('/weddingideas', 'Weddingideas\AdminWeddingideasController@index');
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
    });
/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
| Here is where you can register admin routes for your application.
*/
    Route::get('/search/{cat_slug}/{location?}', 'PageController@getVenuesSearch');

    Route::get('/wedding-vendors/{cat_slug?}', 'PageController@getVenues');
    Route::get('/wedding-venues/{cat_slug?}', 'PageController@getVenues');
    Route::get('/brides/{cat_slug?}', 'PageController@getVenues');
    Route::get('/grooms/{cat_slug?}', 'PageController@getVenues');

    Route::get('/wedding-vendors/{cat_slug}/{venues_slug?}', 'PageController@getVenuesDetails');
    Route::get('/wedding-venues/{cat_slug}/{venues_slug?}', 'PageController@getVenuesDetails');
    Route::get('/wedding-venues/{cat_slug}/{venues_slug}/{idx?}', 'PageController@getVenuesDetails');
    Route::get('/brides/{cat_slug}/{venues_slug?}', 'PageController@getVenuesDetails');
    Route::get('/grooms/{cat_slug}/{venues_slug?}', 'PageController@getVenuesDetails');

    Route::post('wishlist/store','WishlistController@store');
    Route::post('wishlist/remove','WishlistController@remove');

    Route::get('web/{slug}','WeddingWebsiteController@index');
    Route::get('album/{slug}','WeddingWebsiteController@album');
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