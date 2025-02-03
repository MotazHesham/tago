<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::get('social-login/apple','Auth\LoginController@login_social');
Route::post('social-login/callback','Auth\LoginController@callback'); 


//social - login
Route::get('social-login/redirect/{provider}', 'Auth\SocialLoginController@redirectToProvider')->name('social.login');
Route::get('social-login/{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback')->name('social.callback');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth','staff']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('nfc_tool', 'HomeController@nfc_tool')->name('nfc_tool');
    Route::post('show_qr_code', 'HomeController@show_qr_code')->name('show_qr_code');
    

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Customers
    Route::delete('customers/destroy', 'CustomersController@massDestroy')->name('customers.massDestroy');
    Route::post('customers/media', 'CustomersController@storeMedia')->name('customers.storeMedia');
    Route::post('customers/ckmedia', 'CustomersController@storeCKEditorImages')->name('customers.storeCKEditorImages');
    Route::resource('customers', 'CustomersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Settings
    Route::get('settings/shape_delete/{id}', 'SettingsController@shape_delete')->name('settings.shape_delete');
    Route::get('settings/shapes/{id}', 'SettingsController@shapes')->name('settings.shapes');
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::post('settings/media', 'SettingsController@storeMedia')->name('settings.storeMedia');
    Route::post('settings/ckmedia', 'SettingsController@storeCKEditorImages')->name('settings.storeCKEditorImages');
    Route::resource('settings', 'SettingsController');

    // Main Links
    Route::delete('main-links/destroy', 'MainLinksController@massDestroy')->name('main-links.massDestroy');
    Route::post('main-links/media', 'MainLinksController@storeMedia')->name('main-links.storeMedia');
    Route::post('main-links/ckmedia', 'MainLinksController@storeCKEditorImages')->name('main-links.storeCKEditorImages');
    Route::resource('main-links', 'MainLinksController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // User Links
    Route::delete('user-links/destroy', 'UserLinksController@massDestroy')->name('user-links.massDestroy');
    Route::post('user-links/media', 'UserLinksController@storeMedia')->name('user-links.storeMedia');
    Route::post('user-links/ckmedia', 'UserLinksController@storeCKEditorImages')->name('user-links.storeCKEditorImages');
    Route::resource('user-links', 'UserLinksController');

    // Orders
    Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
    Route::post('orders/add_product', 'OrdersController@add_product')->name('orders.add_product');
    Route::get('orders/delete_product/{id}', 'OrdersController@delete_product')->name('orders.delete_product');
    Route::resource('orders', 'OrdersController');

    // Link Category
    Route::delete('link-categories/destroy', 'LinkCategoryController@massDestroy')->name('link-categories.massDestroy');
    Route::resource('link-categories', 'LinkCategoryController');

    // Reviews
    Route::delete('reviews/destroy', 'ReviewsController@massDestroy')->name('reviews.massDestroy');
    Route::resource('reviews', 'ReviewsController');
    
    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::post('countries/update_statuses', 'CountriesController@update_statuses')->name('countries.update_statuses');
    Route::resource('countries', 'CountriesController');

    // Connections
    Route::delete('connections/destroy', 'ConnectionsController@massDestroy')->name('connections.massDestroy');
    Route::post('connections/media', 'ConnectionsController@storeMedia')->name('connections.storeMedia');
    Route::post('connections/ckmedia', 'ConnectionsController@storeCKEditorImages')->name('connections.storeCKEditorImages');
    Route::resource('connections', 'ConnectionsController');
    
    // Tutorials
    Route::delete('tutorials/destroy', 'TutorialsController@massDestroy')->name('tutorials.massDestroy');
    Route::resource('tutorials', 'TutorialsController');

    // Subscribe
    Route::delete('subscribes/destroy', 'SubscribeController@massDestroy')->name('subscribes.massDestroy');
    Route::resource('subscribes', 'SubscribeController');

    // Contactus
    Route::delete('contactus/destroy', 'ContactusController@massDestroy')->name('contactus.massDestroy');
    Route::resource('contactus', 'ContactusController');
    
    // Menu Clients
    Route::delete('menu-clients/destroy', 'MenuClientsController@massDestroy')->name('menu-clients.massDestroy');
    Route::post('menu-clients/media', 'MenuClientsController@storeMedia')->name('menu-clients.storeMedia');
    Route::post('menu-clients/ckmedia', 'MenuClientsController@storeCKEditorImages')->name('menu-clients.storeCKEditorImages');
    Route::resource('menu-clients', 'MenuClientsController');

    // Menu Packages
    Route::delete('menu-packages/destroy', 'MenuPackagesController@massDestroy')->name('menu-packages.massDestroy');
    Route::post('menu-packages/media', 'MenuPackagesController@storeMedia')->name('menu-packages.storeMedia');
    Route::post('menu-packages/ckmedia', 'MenuPackagesController@storeCKEditorImages')->name('menu-packages.storeCKEditorImages');
    Route::resource('menu-packages', 'MenuPackagesController');

    // Menu Themes
    Route::resource('menu-themes', 'MenuThemesController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Menu Client Package
    Route::delete('menu-client-packages/destroy', 'MenuClientPackageController@massDestroy')->name('menu-client-packages.massDestroy');
    Route::resource('menu-client-packages', 'MenuClientPackageController');

    // Menu Client List
    Route::delete('menu-client-lists/destroy', 'MenuClientListController@massDestroy')->name('menu-client-lists.massDestroy');
    Route::post('menu-client-lists/media', 'MenuClientListController@storeMedia')->name('menu-client-lists.storeMedia');
    Route::post('menu-client-lists/ckmedia', 'MenuClientListController@storeCKEditorImages')->name('menu-client-lists.storeCKEditorImages');
    Route::resource('menu-client-lists', 'MenuClientListController');

    // Menu Categories
    Route::delete('menu-categories/destroy', 'MenuCategoriesController@massDestroy')->name('menu-categories.massDestroy');
    Route::post('menu-categories/media', 'MenuCategoriesController@storeMedia')->name('menu-categories.storeMedia');
    Route::post('menu-categories/ckmedia', 'MenuCategoriesController@storeCKEditorImages')->name('menu-categories.storeCKEditorImages');
    Route::resource('menu-categories', 'MenuCategoriesController');

    // Menu Products
    Route::delete('menu-products/destroy', 'MenuProductsController@massDestroy')->name('menu-products.massDestroy');
    Route::resource('menu-products', 'MenuProductsController');

    
    // Company
    Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
    Route::resource('companies', 'CompanyController');

    // Company Packages
    Route::delete('company-packages/destroy', 'CompanyPackagesController@massDestroy')->name('company-packages.massDestroy');
    Route::resource('company-packages', 'CompanyPackagesController');
    
    // Templates 
    Route::post('templates/save', 'TemplatesController@save')->name('templates.save');
    Route::delete('templates/destroy', 'TemplatesController@massDestroy')->name('templates.massDestroy');
    Route::post('templates/media', 'TemplatesController@storeMedia')->name('templates.storeMedia');
    Route::post('templates/ckmedia', 'TemplatesController@storeCKEditorImages')->name('templates.storeCKEditorImages');
    Route::resource('templates', 'TemplatesController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
