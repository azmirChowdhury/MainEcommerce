<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminMassageController;
use App\Http\Controllers\admin\BannersController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\admin\CampaignController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\ContactsHelpsController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\EmailController;
use App\Http\Controllers\admin\ForgotPasswordController;
use App\Http\Controllers\admin\Logo_Background_controller;
use App\Http\Controllers\admin\NotesController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\Admin\ParentsMenuBlocksController;
use App\Http\Controllers\Admin\ParentsMenuController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\purchase_settingsController;
use App\Http\Controllers\admin\SeoScriptionController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\Social_iconControlle;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExceptionController;
use App\Http\Controllers\front_end\ContactsController;
use App\Http\Controllers\front_end\CustomerForgetPasswordController;
use App\Http\Controllers\front_end\FrontHomeController;
use App\Http\Controllers\front_end\FrontProductController;
use App\Http\Controllers\front_end\LoginRegisterController;
use App\Models\CustomerModel;
use App\Models\User;
use App\Notifications\CommentNotification;
use Illuminate\Support\Facades\Route;


route::fallback([ExceptionController::class, 'admin404']);


Route::get('/',[FrontHomeController::class,'index']);

//************* Add Parents menu **********************
route::middleware('PreventCashControl')->group(function () {
route::middleware(['DashboardAuth', 'AdminStatusValidation'])->group(function () {

    route::group(['middleware' => 'email'], function () {
        route::get('/dashboard/email/email-manager', [EmailController::class, 'index'])->name('email');
        route::post('/dashboard/email/compose-send', [EmailController::class, 'send_mail'])->name('send_mail');

//        ******************* massage ************
        route::get('/dashboard/message/message-manage',[AdminMassageController::class,'index'])->name('inbox_massage');
        route::get('/dashboard/message/{name}/full-view{id}',[AdminMassageController::class,'full_view_message'])->name('full_view_message');
        route::get('/dashboard/message/reply/{email}{id}',[AdminMassageController::class,'message_reply'])->name('message_reply');
        route::post('/dashboard/message/message',[AdminMassageController::class,'delete_message'])->name('delete_message');

    });
    route::group(['middleware' => 'parentMenu'], function () {

        route::get('/dashboard/add/{slug}', [ParentsMenuController::class, 'index'])->name('add_parents_menu');
        route::get('/dashboard/manage/{slug}', [ParentsMenuController::class, 'manage_parents_category'])->name('manage_parents_category');
        route::POST('/dashboard/saved/parents/category', [ParentsMenuController::class, 'save_parents_category'])->name('save_parents_category');
        route::get('/dashboard/manage/edit/{id}{slug}', [ParentsMenuController::class, 'edit_parents_category'])->name('edit_parents_category');
        route::post('/dashboard/manage/edit/edit-parents-category-saved', [ParentsMenuController::class, 'edit_parents_category_saved'])->name('edit_parents_category_saved');
        route::get('/dashboard/parents/catecory/manage/update/status/published{id}{slug}', [ParentsMenuController::class, 'status_published'])->name('status_update_published');
        route::get('/dashboard/parents/category/manage/update/status/unpublished{id}{slug}', [ParentsMenuController::class, 'status_unpublished'])->name('status_update_unpublished');
        route::get('/dashboard/parents/category/delete/{id}{slug}', [ParentsMenuController::class, 'delete_parents_category'])->name('delete_parents_category');

    });

//***************************** HTML Bocks **********************************
    route::group(['middleware' => 'htmlBlocks'], function () {
        route::get('/dashboard/html-blocks/parents-category-blocks', [ParentsMenuBlocksController::class, 'index'])->name('parents_menu_blocks');
        route::get('/dashboard/html-blocks/parents-category-blocks-add', [ParentsMenuBlocksController::class, 'parents_menu_blocks_add'])->name('parents_menu_blocks_add');
        route::post('/dashboard/html-blocks/parents-category-blocks-save', [ParentsMenuBlocksController::class, 'parents_menu_blocks_save'])->name('parents_menu_blocks_save');
        route::get('/dashboard/html-blocks/{id}edit', [ParentsMenuBlocksController::class, 'edit_blocks'])->name('edit_blocks');
        route::post('/dashboard/html-blocks/save', [ParentsMenuBlocksController::class, 'edit_blocks_save'])->name('edit_blocks_save');
        route::get('/dashboard/html-blocks/{id}status-publish', [ParentsMenuBlocksController::class, 'status_publish'])->name('status_publish');
        route::get('/dashboard/html-blocks/{id}status-unpublished', [ParentsMenuBlocksController::class, 'status_unpublished'])->name('status_unpublished');
        route::get('/dashboard/html-blocks/{id}/d-e-l-delete', [ParentsMenuBlocksController::class, 'delete_block'])->name('delete_block');
    });
//******************************* sub category  *************************************
    route::group(['middleware' => 'subcategory'], function () {
        route::get('/dashboard/category/subcategory', [SubCategoryController::class, 'index'])->name('index');
        route::get('/dashboard/category/subcategory/blocks/load', [SubCategoryController::class, 'ajax_blocks_load'])->name('ajax_blocks_load');
        route::post('/dashboard/category/subcategory/save', [SubCategoryController::class, 'sub_category_save'])->name('sub_category_save');
        route::get('/dashboard/category/subcategory/manage', [SubCategoryController::class, 'manage_subcategory'])->name('manage_subcategory');
        route::get('/dashboard/category/subcategory/status/{id}-published', [SubCategoryController::class, 'publish_status'])->name('publish_status');
        route::get('/dashboard/category/subcategory/status/{id}-unpublished', [SubCategoryController::class, 'unpublished_status'])->name('unpublished_status');
        route::get('/dashboard/category/subcategory/edit/{id}category', [SubCategoryController::class, 'edit_subcategory'])->name('edit_subcategory');
        route::post('/dashboard/category/subcategory/edit/category/save', [SubCategoryController::class, 'edit_sub_category_save'])->name('edit_sub_category_save');
        route::get('/dashboard/category/subcategory/delete/{id}delete', [SubCategoryController::class, 'delete_subcategory'])->name('delete_subcategory');
    });


//*************************** Brands **********************************
    route::group(['middleware' => 'brand'], function () {
        route::get('/dashboard/add/brand/{slug}', [BrandController::class, 'index'])->name('add_brand');
        route::get('/dashboard/manage/brands/{slug}', [BrandController::class, 'manage_brand'])->name('manage_brand');
        route::post('/dashboard/save/brands/save', [BrandController::class, 'save_brand'])->name('save_brand');
        route::get('/dashboard/brands/{id}publish', [BrandController::class, 'brand_publish'])->name('brand_publish');
        route::get('/dashboard/brands/{id}unpublished', [BrandController::class, 'brand_unpublished'])->name('brand_unpublished');
        route::get('/dashboard/brands/{id}/{slug}/edit', [BrandController::class, 'edit_brand'])->name('edit_brand');
        route::post('/dashboard/brands/edit/save', [BrandController::class, 'edit_save_brand'])->name('edit_save_brand');
        route::get('/dashboard/delete/{id}/brand', [BrandController::class, 'delete_brand'])->name('delete_brand');
    });


//*************************** Size management ******************************
    route::group(['middleware' => 'size_color'], function () {
        route::get('/dashboard/size&color/size-manage', [SizeController::class, 'index'])->name('size');
        route::get('/dashboard/size/add/view', [SizeController::class, 'size_add_view'])->name('size_add_view');
        route::post('/dashboard/color-save/size/save', [SizeController::class, 'size_save'])->name('size_save');
        route::post('/dashboard/color&save/size/update', [SizeController::class, 'update_size'])->name('update_size');
        route::get('/dashboard/color&save/size/{id}/delete', [SizeController::class, 'delete_size'])->name('delete_size');


//*************************** Color management ******************************
        route::get('/dashboard/size&color/color-manage', [ColorController::class, 'index'])->name('color');
        route::get('/dashboard/color/add/view', [ColorController::class, 'color_add_view'])->name('color_add_view');
        route::post('/dashboard/color-save/color/save', [ColorController::class, 'color_save'])->name('color_save');
        route::get('/dashboard/color/edit/{id}/view', [ColorController::class, 'color_edit_view'])->name('color_edit_view');
        route::post('/dashboard/color&save/color/update', [ColorController::class, 'update_color'])->name('update_color');
        route::get('/dashboard/color&save/color/{id}/delete', [ColorController::class, 'delete_color'])->name('delete_color');

    });


//*************************** Product ******************************
    route::group(['middleware' => 'product'], function () {
        route::get('dashboard/products/add-product', [ProductController::class, 'index'])->name('index_view');
        route::post('dashboard/product/save/product', [ProductController::class, 'save_product'])->name('all_save_product');
        route::get('dashboard/products/manage-products', [ProductController::class, 'manage_products'])->name('manage_products');
        route::get('dashboard/product{id}/status/unpublished', [ProductController::class, 'unpublished_product'])->name('unpublished_product');
        route::get('dashboard/product{id}/status/publish', [ProductController::class, 'publish_product'])->name('publish_product');
        route::get('dashboard/product{id}/full/details', [ProductController::class, 'product_full_details'])->name('product_full_details');
        route::get('dashboard/product/{id}/delete', [ProductController::class, 'delete_product'])->name('delete_product');
        route::get('dashboard/product/{id}/{slug}/edit/product', [ProductController::class, 'edit_product'])->name('edit_product');
        route::post('dashboard/product/save/edit/product', [ProductController::class, 'save_edit_product'])->name('save_edit_product');
        route::get('dashboard/product/out-of-stock-product', [ProductController::class, 'stock_out_product'])->name('stock_out_product');
        route::post('dashboard/product/out-of-stock/update', [ProductController::class, 'product_stock_update'])->name('product_stock_update');
    });
//**************************************** Campaign **************************************

    route::group(['middleware' => 'deals'], function () {
        route::get('dashboard/campaign/manage-campaign', [CampaignController::class, 'index'])->name('index_campaign');
        route::get('dashboard/campaign/add-campaign', [CampaignController::class, 'add_campaign'])->name('add_campaign');
        route::post('dashboard/campaign/save-campaign', [CampaignController::class, 'save_campaign'])->name('save_campaign');
        route::get('dashboard/campaign/{id}edit-campaign', [CampaignController::class, 'edit_campaign'])->name('edit_campaign');
        route::post('dashboard/campaign/edit-save-campaign', [CampaignController::class, 'edit_save_campaign'])->name('edit_save_campaign');
        route::get('dashboard/campaign{id}/delete-campaign', [CampaignController::class, 'delete_campaign'])->name('delete_campaign');
        route::get('dashboard/campaign{id}/publish-campaign', [CampaignController::class, 'published_campaign'])->name('published_campaign');
        route::get('dashboard/campaign{id}/unpublished-publish-campaign', [CampaignController::class, 'unpublished_campaign'])->name('unpublished_campaign');

    });

//************************************** coupon *************************************
    route::group(['middleware' => 'coupon'], function () {
        route::get('dashboard/coupon/manage-coupon', [CouponController::class, 'index'])->name('index_coupon');
        route::get('dashboard/coupon/add-coupon', [CouponController::class, 'add_coupon'])->name('add_coupon');
        route::post('dashboard/coupon/save-coupon', [CouponController::class, 'save_coupon'])->name('save_coupon');
        route::get('dashboard/coupon/{id}edit-coupon', [CouponController::class, 'edit_coupon'])->name('edit_coupon');
        route::post('dashboard/coupon/edit-save-coupon', [CouponController::class, 'edit_save_coupon'])->name('edit_save_coupon');
        route::get('dashboard/coupon{id}/delete-coupon', [CouponController::class, 'delete_coupon'])->name('delete_coupon');
        route::get('dashboard/coupon{id}/publish-coupon', [CouponController::class, 'published_coupon'])->name('published_coupon');
        route::get('dashboard/coupon{id}/unpublished-publish-coupon', [CouponController::class, 'unpublished_coupon'])->name('unpublished_coupon');
    });
//************************ admin slider *******************************
    route::group(['middleware' => 'slider'], function () {
        route::get('/dashboard/appearance/slider-manage', [SliderController::class, 'index'])->name('slider_index');
        route::get('/dashboard/appearance/slider-add', [SliderController::class, 'slider_add'])->name('slider_add');
        route::post('/dashboard/appearance/slider-save', [SliderController::class, 'save_slider'])->name('save_slider');
        route::get('/dashboard/appearance/{id}slider-edit', [SliderController::class, 'edit_slider'])->name('edit_slider');
        route::post('/dashboard/appearance/edit-slider-save', [SliderController::class, 'edit_slider_save'])->name('edit_slider_save');
        route::get('/dashboard/appearance/{id}slider-published', [SliderController::class, 'slider_publish'])->name('slider_publish');
        route::get('/dashboard/appearance/{id}slider-unpublished', [SliderController::class, 'slider_unpublished'])->name('slider_unpublished');
        route::get('/dashboard/appearance/{id}slider-delete', [SliderController::class, 'slider_delete'])->name('slider_delete');
    });
//****************************** Appearance **************************************
    route::group(['middleware' => 'appearance'], function () {
        route::get('/dashboard/appearance/logo-background-management', [Logo_Background_controller::class, 'index'])->name('logo_background_index');
        route::post('/dashboard/appearance/logo-background-save', [Logo_Background_controller::class, 'update_information'])->name('update_logo_other');
        route::post('/dashboard/appearance/logo-background-new-save', [Logo_Background_controller::class, 'new_appearance'])->name('new_appearance');

//******************************** Banners ********************************************
        route::get('/dashboard/appearance/banners/manage-banners', [BannersController::class, 'index'])->name('banners_manage');
        route::get('/dashboard/appearance/banners/add-banner', [BannersController::class, 'banners_add'])->name('banners_add');
        route::post('/dashboard/appearance/banners/save-new-banner', [BannersController::class, 'save_new_banner'])->name('save_banner');
        route::get('/dashboard/appearance/banners{id}/edit-banner', [BannersController::class, 'edit_banner'])->name('edit_banner');
        route::post('/dashboard/appearance/banners/save-edit-banner', [BannersController::class, 'edit_save_banner'])->name('edit_save_banner');
        route::get('/dashboard/appearance/banners{id}/delete-banner', [BannersController::class, 'delete_banner'])->name('delete_banner');
        route::get('/dashboard/appearance/banners{id}/publish-banner', [BannersController::class, 'publish_banner'])->name('publish_banner');
        route::get('/dashboard/appearance/banners{id}/unpublished-banner', [BannersController::class, 'unpublished_banner'])->name('unpublished_banner');
        route::get('/dashboard/appearance/banners{id}/full-view-banner', [BannersController::class, 'full_view_banner'])->name('full_view_banner');
    });

//************************** SEO meta and scripting **************************************
    route::group(['middleware' => 'utilities'], function () {
        route::get('/dashboard/utilities/seo-script-manage', [SeoScriptionController::class, 'index'])->name('manage_script');
        route::get('/dashboard/utilities/seo-script-add', [SeoScriptionController::class, 'add_meta_script'])->name('add_meta_script');
        route::post('/dashboard/utilities/seo-script-save', [SeoScriptionController::class, 'meta_script_save'])->name('meta_script_save');
        route::get('/dashboard/utilities/seo-script-{id}edit', [SeoScriptionController::class, 'edit_meta'])->name('edit_meta');
        route::post('/dashboard/utilities/seo-script-update', [SeoScriptionController::class, 'edit_update'])->name('edit_update');
        route::get('/dashboard/utilities/seo-script-{id}publish', [SeoScriptionController::class, 'tag_publish'])->name('tag_publish');
        route::get('/dashboard/utilities/seo-script-{id}unpublished', [SeoScriptionController::class, 'tag_unpublished'])->name('tag_unpublished');
        route::get('/dashboard/utilities/seo-script-{id}-delete', [SeoScriptionController::class, 'tag_delete'])->name('tag_delete');

//************************************ Social icon manage /social share*********************************
        route::get('/dashboard/utilities/social-share-manage', [Social_iconControlle::class, 'index'])->name('manage_icon');
        route::get('/dashboard/utilities/social-share-new-add', [Social_iconControlle::class, 'add_link'])->name('add_link');
        route::post('/dashboard/utilities/social-link-save', [Social_iconControlle::class, 'save_link'])->name('save_link');
        route::get('/dashboard/utilities/social-share-{id}-edit', [Social_iconControlle::class, 'edit_icon'])->name('edit_icon');
        route::post('/dashboard/utilities/social-link-edit-save', [Social_iconControlle::class, 'save_edit_link'])->name('save_edit_link');
        route::get('/dashboard/utilities/social-share-{id}-publish', [Social_iconControlle::class, 'icon_publish'])->name('icon_publish');
        route::get('/dashboard/utilities/social-share-{id}-unpublished', [Social_iconControlle::class, 'icon_unpublished'])->name('icon_unpublished');
        route::get('/dashboard/utilities/social-share-{id}-delete', [Social_iconControlle::class, 'icon_delete'])->name('icon_delete');

//************************************ Contact information *********************************
        route::get('/dashboard/utilities/contacts-help-manage', [ContactsHelpsController::class, 'index'])->name('manage_contact');
        route::get('/dashboard/utilities/contacts-help-new-add', [ContactsHelpsController::class, 'add_contact'])->name('add_contact');
        route::post('/dashboard/utilities/contacts-help-save', [ContactsHelpsController::class, 'save_contact'])->name('save_contact');
        route::get('/dashboard/utilities/contacts-help-{id}-edit', [ContactsHelpsController::class, 'edit_contact'])->name('edit_contact');
        route::post('/dashboard/utilities/contacts-help-edit-save', [ContactsHelpsController::class, 'save_edit_contact'])->name('save_edit_contact');
        route::get('/dashboard/utilities/contacts-help-{id}-publish', [ContactsHelpsController::class, 'contact_publish'])->name('contact_publish');
        route::get('/dashboard/utilities/contacts-help-{id}-unpublished', [ContactsHelpsController::class, 'contact_unpublished'])->name('contact_unpublished');
        route::get('/dashboard/utilities/contacts-help-{id}-delete', [ContactsHelpsController::class, 'contact_delete'])->name('contact_delete');


//********************************** Purchase settings ******************************************

        route::get('/dashboard/utilities/purchase-settings', [purchase_settingsController::class, 'index'])->name('purchase_settings');
        route::post('/dashboard/utilities/purchase-setting-shipping-save', [purchase_settingsController::class, 'shipping_save'])->name('shipping_save');
        route::get('/dashboard/utilities/purchase-shipping-{id}-edit', [purchase_settingsController::class, 'edit_shipping'])->name('edit_shipping');
        route::post('/dashboard/utilities/purchase-setting-shipping-edit-save', [purchase_settingsController::class, 'shipping_edit_save'])->name('shipping_edit_save');
        route::get('/dashboard/utilities/purchase-shipping-{id}-delete', [purchase_settingsController::class, 'delete_shipping'])->name('delete_shipping');
        route::get('/dashboard/utilities/purchase-shipping-{id}-published', [purchase_settingsController::class, 'publish_shipping'])->name('publish_shipping');
        route::get('/dashboard/utilities/purchase-shipping-{id}-unpublished', [purchase_settingsController::class, 'unpublished_shipping'])->name('unpublished_shipping');


//********************************** TAX ******************************
        route::post('/dashboard/tax/added-update', [purchase_settingsController::class, 'texUpdate'])->name('tex_update');
//********************************** payment method ******************************
        route::get('/dashboard/utilities/purchase-payment-{id}-published', [purchase_settingsController::class, 'publish_payment'])->name('publish_payment');
        route::get('/dashboard/utilities/purchase-payment-{id}-unpublished', [purchase_settingsController::class, 'unpublished_payment'])->name('unpublished_payment');
        route::get('/dashboard/utilities/purchase-payment-{id}-delete', [purchase_settingsController::class, 'delete_payment'])->name('delete_payment');
        route::get('/dashboard/utilities/purchase-payment-{id}-edit', [purchase_settingsController::class, 'edit_payment'])->name('edit_payment');
        route::post('/dashboard/utilities/purchase-setting-payment-edit-save', [purchase_settingsController::class, 'payment_edit_save'])->name('payment_edit_save');

//********************************** Notes Settings******************************************

        route::post('/dashboard/utilities/purchase-setting-notes-save', [NotesController::class, 'notes_save'])->name('notes_save');
        route::get('/dashboard/utilities/purchase-notes-{id}-edit', [NotesController::class, 'edit_notes'])->name('edit_notes');
        route::post('/dashboard/utilities/purchase-notes-note-edit-save', [NotesController::class, 'notes_edit_save'])->name('notes_edit_save');
        route::get('/dashboard/utilities/purchase-notes-{id}-delete', [NotesController::class, 'delete_notes'])->name('delete_notes');
        route::get('/dashboard/utilities/purchase-notes-{id}-published', [NotesController::class, 'publish_notes'])->name('publish_notes');
        route::get('/dashboard/utilities/purchase-notes-{id}-unpublished', [NotesController::class, 'unpublished_notes'])->name('unpublished_notes');

    });

    //************************************ Create page *********************************
    route::group(['middleware' => 'page'], function () {
        route::get('/dashboard/pages/pages-create-manage', [PagesController::class, 'index'])->name('manage_page');
        route::get('/dashboard/pages/pages-create-new-add', [PagesController::class, 'add_page'])->name('add_page');
        route::post('/dashboard/pages/pages-create-save', [PagesController::class, 'save_page'])->name('save_page');
        route::get('/dashboard/pages/pages-create-{id}-edit', [PagesController::class, 'edit_page'])->name('edit_page');
        route::post('/dashboard/pages/pages-create-edit-save', [PagesController::class, 'save_edit_page'])->name('save_edit_page');
        route::get('/dashboard/pages/pages-create-{id}-publish', [PagesController::class, 'page_publish'])->name('publish_page');
        route::get('/dashboard/pages/pages-create-{id}-unpublished', [PagesController::class, 'page_unpublished'])->name('unpublished_page');
        route::get('/dashboard/pages/pages-create-{id}-delete', [PagesController::class, 'page_delete'])->name('page_delete');
    });

//******************************** admin *****************************/
    route::group(['middleware' => 'AdminValidation'], function () {
        route::get('admin/main-admin-manage-admin', [AdminController::class, 'index'])->name('manage_admin');
//        route::get('admin/main-admin-register',[AdminController::class,'register_admin'])->name('register_admin');
        route::post('admin/main-admin-delete', [AdminController::class, 'UserDelete'])->name('user_delete');
        route::get('admin/main-admin{id}-publish', [AdminController::class, 'publish_admin'])->name('publish_admin');
        route::get('admin/main-admin{id}-unpublished', [AdminController::class, 'unpublished_admin'])->name('unpublished_admin');
        route::get('admin/main-admin{id}-edit-co-user', [AdminController::class, 'edit_co_user'])->name('edit_co_user');
        route::post('admin/main-admin-edit-co-user-save', [AdminController::class, 'edit_user_save'])->name('edit_user_save');
        route::get('admin/main-co-admin-{id}password-change', [AdminController::class, 'change_password'])->name('change_password');
        route::post('admin/main-co-admin-password-change-save', [AdminController::class, 'change_password_save'])->name('change_password_save');
    });

//************************ manage customers ****************************
    route::group(['middleware'=>'customer'],function (){
        route::get('/dashboard/users/{slug}', [\App\Http\Controllers\admin\CustomerController::class, 'index'])->name('all_customers');
        route::get('/dashboard/customer-active/{id}', [\App\Http\Controllers\admin\CustomerController::class, 'active_customer'])->name('active_customer');
        route::get('/dashboard/customer-stopped/{id}', [\App\Http\Controllers\admin\CustomerController::class, 'stopped_customer'])->name('stopped_customer');
        route::get('/dashboard/customer-details/{id}', [\App\Http\Controllers\admin\CustomerController::class, 'customer_details'])->name('customer_details');
        route::get('/dashboard/delete-customer/{id}', [\App\Http\Controllers\admin\CustomerController::class, 'delete_customer'])->name('delete_customer');



    });


    Route::middleware(['auth:sanctum', 'verified', 'admin','PreventCashControl'])->get('/admin-panel', function () {
        return view('back_end.home.home');
    })->name('dashboard');


//*********************** admin password reset ************************************
    route::get('User/admin-password-reset', [ForgotPasswordController::class, 'index'])->name('password_reset_show');
    route::post('User/admin-password-reset-request', [ForgotPasswordController::class, 'reset_request'])->name('reset_request');
    route::get('User/admin-password-reset{token}', [ForgotPasswordController::class, 'new_password_set'])->name('new_password_set');
    route::post('User/admin-password-set-new-save', [ForgotPasswordController::class, 'new_password_set_save'])->name('new_password_set_save');
});

});


//*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*= Start Front sit route*=*=*=*=*=*=*=*=*=**=*=*=**=*=**=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=**=*=*=*=*=*=*=*=*=*=*=**=*=*=*=*=*=*=*=*=*=*

//********************************************** Products **************************************************

route::get('{slug}{id}/show', [FrontProductController::class, 'single_product'])->name('single_product');
route::get('{slug}/{id}/{paginate}/shop', [FrontProductController::class, 'category_show_product'])->name('category_show_product');
route::post('view/product-with-paginate/category', [FrontProductController::class, 'view_paginate'])->name('view_paginate');
route::get('price-range/{paginate}/shop', [FrontProductController::class, 'price_range'])->name('price_range');
route::get('search-suggestion/load-ajax', [FrontProductController::class, 'search_suggestion'])->name('search_suggestion');
route::get('search-shop-product-{paginate}', [FrontProductController::class, 'search_shop'])->name('search_shop');
route::get('show-all-product', [FrontProductController::class, 'show_all_product'])->name('show_all_product');


//********************************* Contact us *******************************************
route::get(env('app_name') .'-contacts-us', [ContactsController::class, 'index'])->name('contactus');
route::post('contact-massage-send', [ContactsController::class, 'send_massage'])->name('contact_massage_send');



//********************************* Customer login or register *******************************************
route::middleware(['CustomerHasLogin','PreventCashControl'])->group( function () {
    route::get(env('app_name') . '-login-or-register', [LoginRegisterController::class, 'index'])->name('loginRegister');
    route::post('new-customer-register', [LoginRegisterController::class, 'resister_customer'])->name('resister_customer');
    route::get('customer/account-create-conformation{token}', [LoginRegisterController::class, 'customer_register_confirm']);
    route::post('customer-login', [LoginRegisterController::class, 'CustomerLogin'])->name('customer_login');
});
route::middleware(['CustomerDashboard','PreventCashControl'])->group( function () {
    route::get('customer/account-dashboard', [LoginRegisterController::class, 'customer_dashboard'])->name('customer_dashboard');
    route::post('customer/logout', [LoginRegisterController::class, 'customer_logout'])->name('customer_logout');
    route::post('account-details-change', [LoginRegisterController::class, 'change_account_details'])->name('account_details_change');
    route::post('account-address-change', [LoginRegisterController::class, 'change_account_address'])->name('account_address_change');
});

//************************************** Customer forget Password ************************************
route::group(['middleware' => 'CustomerHasLogin'], function () {
    route::get('Customer-password-reset', [CustomerForgetPasswordController::class, 'index'])->name('customer_password_reset_show');
    route::post('customer-password-reset-request', [CustomerForgetPasswordController::class, 'reset_request'])->name('customer_reset_request');
    route::get('customer-password-reset{token}', [CustomerForgetPasswordController::class, 'new_password_set'])->name('customer_new_password_set');
    route::post('customer-password-set-new-save', [CustomerForgetPasswordController::class, 'new_password_set_save'])->name('customer_new_password_set_save');
});







