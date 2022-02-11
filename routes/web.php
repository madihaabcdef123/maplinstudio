<?php

use App\Http\Controllers\ApiFeedsController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GenericController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LeaveApplicationController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::get('/', [IndexController::class, 'index'])->name('welcome');
Route::get('/home', [IndexController::class, 'index'])->name('welcome');


Route::get('/signup', [IndexController::class, 'signup'])->name('signup');
Route::get('/planning', [IndexController::class, 'planning'])->name('planning');
Route::get('/project', [IndexController::class, 'project'])->name('project');
Route::get('/studio', [IndexController::class, 'studio'])->name('studio');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
Route::get('/news', [IndexController::class, 'news'])->name('news');
Route::get('/career', [IndexController::class, 'career'])->name('career');

Route::get('/book-expert', [IndexController::class, 'book_expert'])->name('book_expert');
Route::get('/book-expert-detail/{id}', [IndexController::class, 'book_expert_detail'])->name('book_expert_detail');

Route::get('/career-detail/{id}', [IndexController::class, 'career_detail'])->name('career_detail');
Route::get('/project-detail/{id}', [IndexController::class, 'project_detail'])->name('project_detail');
Route::get('/disclaimer', [IndexController::class, 'disclaimer'])->name('disclaimer');
Route::get('/privacy', [IndexController::class, 'privacy'])->name('privacy');
Route::get('/terms', [IndexController::class, 'terms'])->name('terms');
Route::get('/studio-detail/{id}', [IndexController::class, 'studio_detail'])->name('studio_detail');


Route::post('/newsletter-submit', [IndexController::class, 'newsletter_submit'])->name('newsletter_submit'); 

// Add Links start
Route::get('/checkout', [IndexController::class, 'checkout'])->name('checkout');
Route::post('/checkout-submit', [IndexController::class, 'checkout_submit'])->name('checkout_submit');
Route::get('/paylink-paypal/{oid?}/{code?}', [IndexController::class, 'paylink_paypal'])->name('paylink-paypal');
Route::get('/paylink-stripe/{oid?}/{code?}', [IndexController::class, 'paylink_stripe'])->name('paylink-stripe');
Route::post('/payout_submit', [IndexController::class, 'payout_submit'])->name('payout_submit');

Route::post('/contact-submit', [IndexController::class, 'contact_submit'])->name('contact_submit');

 Route::get('modal-form', [IndexController::class,'modal_form'])->name('modal_form');

 Route::get('thank-you-upload', [IndexController::class,'thank_you_upload'])->name('thank_you_upload');

   Route::get('news-detail/{id?}', [IndexController::class,'news_detail_display'])->name('news_detail_display');



Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});



Route::post('validator', [RegistrationController::class, 'validator_check'])->name('validator_check');

  Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/stripe', [paymentController::class, 'stripe_payment'])->name('stripe_payment');
    Route::post('/payout', [paymentController::class, 'payout'])->name('payout');

    Route::get('/stripe-response', [paymentController::class, 'stripe_response'])->name('stripe_response');

    // Upload Multiple Images 
    Route::get('/upload-gallery/{model}/{id}', [HomeController::class, 'upload_gallery'])->name('upload_gallery');
    Route::post("upload-multiple-images-submit", [HomeController::class, 'images_submit'])->name('images_submit');


    Route::post('/stripe-checkout', [paymentController::class, 'stripe_chekout_session'])->name('stripe_chekout_session');
    Route::get('/user-profile-view', [HomeController::class, 'user_profile'])->name('user_profile');
    Route::get('/steps', [HomeController::class, 'steps'])->name('steps');
    Route::get('/switch-project/{id}', [HomeController::class, 'switch_project'])->name('switch_project');
    Route::get('/profile', [HomeController::class, 'user_profile'])->name('user_profile');
    Route::get('/user-profile', [HomeController::class, 'user_profile'])->name('user_profile');
    Route::post('/user-info-update', [HomeController::class, 'user_infoupdate'])->name('user_infoupdate');
    Route::get('/user-office-details', [HomeController::class, 'user_office_details'])->name('user_office_details');
    Route::post('/user-office-info-update', [HomeController::class, 'user_office_infoupdate'])->name('user_office_infoupdate');
    Route::post('/user-file-info-update', [HomeController::class, 'user_file_infoupdate'])->name('user_file_infoupdate');
    Route::get('/user-file-details', [HomeController::class, 'user_file_details'])->name('user_file_details');
    Route::post('/user-photo-update', [HomeController::class, 'upload_image'])->name('upload_image');
    Route::post('/profile-submit', [HomeController::class, 'profile_submit'])->name('profile_submit');
    Route::get('/user-rights', [HomeController::class, 'user_rights'])->name('user_rights');
    Route::get('/inquiry-manage', [HomeController::class, 'inquiry_manage'])->name('inquiry_manage');
     Route::get('applied-job-view', [HomeController::class, 'applied_job_view'])->name('applied_job_view');



    Route::get('/newsletter-manage', [HomeController::class, 'newsletter_manage'])->name('newsletter_manage');
    // Reports Routes
    Route::post('/user-updates', [HomeController::class, 'user_updates'])->name('user_updates');
    Route::post('/shift-change', [HomeController::class, 'shift_change'])->name('shift_change');

    Route::get('/registered-user-report', [ReportController::class, 'registered_user_report'])->name('registered_user_report');
    Route::get('/all-user-report/{slug?}', [ReportController::class, 'all_registered_user_report'])->name('all_registered_user_report');


    Route::get('/attendance-sheet-import', [ReportController::class, 'attendance_sheet_import'])->name('attendance_sheet_import');
    Route::post('attendance-import-submit', [ReportController::class, 'attendance_import_submit'])->name('attendance_import_submit');

    Route::get('/all-leave-application-report', [ReportController::class, 'all_leave_application_report'])->name('all_leave_application_report');

    Route::get('/birthday-list', [ReportController::class, 'birthday_list'])->name('birthday_list');

    // Reports Routes End
    Route::post('/{slug?}/create', [GenericController::class, 'crud_generator'])->name('crud_generator');


    Route::get('/attributes', [GenericController::class, 'roles'])->name('roles');
    Route::get('/attribute/{slug}', [GenericController::class, 'listing'])->name('listing');
    Route::post('/delete-record', [GenericController::class, 'delete_record'])->name('delete_record');
    Route::get('/report/{slug}', [GenericController::class, 'report_user'])->name('report_user');
    Route::post('/custom-report', [GenericController::class, 'custom_report'])->name('custom_report');
    Route::get('/custom-report/{slug}/{slug2}', [GenericController::class, 'custom_report_user'])->name('custom_report_user');
    Route::post('/generic-submit', [GenericController::class, 'generic_submit'])->name('generic_submit');
    Route::post('/assign-role-submit', [GenericController::class, 'roleassign_submit'])->name('roleassign_submit');
    Route::post('/role-assign-modal', [GenericController::class, 'role_assign_modal'])->name('role_assign_modal');

    Route::get('/all-invoice', [GenericController::class, 'invoiceView'])->name('invoiceView');

    Route::get('/services', [ServicesController::class, 'services'])->name('services');

    // Payroll Routes
    Route::get('/payroller', [PayrollController::class, 'payroller'])->name('payroller');
    Route::post('/payroll-month-report', [PayrollController::class, 'payroll_month_report'])->name('payroll_month_report');

    Route::get('/payslips', [PayrollController::class, 'payslips'])->name('payslips');
    Route::get('/view-payslip/{id}', [PayrollController::class, 'view_payslip'])->name('view_payslip');
    Route::post('/payslip-generate', [PayrollController::class, 'payslip_generate'])->name('payslip_generate');
    // Payroll Routes End

    // Chat Room
    Route::get('chat', [ChatController::class, 'chat'])->name('chat');
    Route::post('save-msg', [ChatController::class, 'save_msg'])->name('save_msg');
    Route::post('fetch-messages', [ChatController::class, 'fetch_msg'])->name('fetch_msg');

    // Leave Application Form
    Route::get('all-leave-application', [LeaveApplicationController::class, 'all_leave_application'])->name('all_leave_application');
    Route::get('leave-applicaton/show', [LeaveApplicationController::class, 'leave_show'])->name('leave_show');
    Route::get('leave-applicaton/team-show', [LeaveApplicationController::class, 'leave_teamshow'])->name('leave_teamshow');
    Route::post('leave-applicaton-submit', [LeaveApplicationController::class, 'leave_submit'])->name('leave_submit');
    Route::get('leave-applicaton-delete/{id}', [LeaveApplicationController::class, 'application_delete'])->name('application_delete');
    Route::post('update-team-leave-applicaton', [LeaveApplicationController::class, 'update_leave_form'])->name('update_leave_form');
    Route::post('leave-form-validate', [LeaveApplicationController::class, 'leave_form_validate'])->name('leave_form_validate');

    // Candidate Form
    // Step 1
    Route::get('dashboard/job/get-started/{id?}', [CandidateController::class, 'step1_form'])->name('step1_form');
    Route::get('dashboard/job/include-details/{id?}', [CandidateController::class, 'step3_form'])->name('step3_form');
    Route::get('dashboard/job/compensation-details/{id?}', [CandidateController::class, 'step4_form'])->name('step4_form');
    Route::get('dashboard/job/job-description/{id?}', [CandidateController::class, 'step5_form'])->name('step5_form');

   Route::post('apply-job', [CandidateController::class, 'apply_job'])->name('apply_job');

 

    Route::get('application', [CandidateController::class, 'candidate_form'])->name('candidate_form');
    Route::get('dashboard/job/create/{id?}', [CandidateController::class, 'create_job'])->name('create_job');
    Route::get('dashboard/job/company-profile/{id?}', [CandidateController::class, 'company_profile'])->name('company_profile');


    Route::post('dashboard/job/save', [CandidateController::class, 'job_create_save'])->name('job_create_save');
    Route::post('dashboard/company/save', [CandidateController::class, 'company_create_save'])->name('company_create_save');
    Route::post('dashboard/company/logo', [CandidateController::class, 'companylogo_submit'])->name('companylogo_submit');

    Route::get('dashboard/jobs', [CandidateController::class, 'job_display'])->name('job_display');
    Route::get('dashboard/job-edit/{id?}', [CandidateController::class, 'job_edit'])->name('job_edit');

    // Send Message to telegram
    Route::get('configure-settings', [HomeController::class, 'config'])->name('config');
    Route::post('config-update', [HomeController::class, 'config_update'])->name('config_update');
    Route::get('send-message', [TelegramController::class, 'sendMessage'])->name('sendMessage');

    Route::post('connect-user', [TelegramController::class, 'connectUser'])->name('connectUser');


    
    Route::post('modalform', [HomeController::class, 'modalform'])->name('modalform');
    Route::post('cms_generator', [HomeController::class, 'cms_generator'])->name('cms_generator');
});

Route::middleware([customer::class])->group(function () {

    Route::get("user-dashboard", [CustomerController::class, 'index'])->name('index');
    Route::get("education", [CustomerController::class, 'education'])->name('education');
    Route::get("edit-profile", [CustomerController::class, 'edit_profile'])->name('editprofile');
    Route::get("reset-password", [CustomerController::class, 'reset_Password'])->name('resetpassword');
    Route::get("view-weekly-breakdown", [CustomerController::class, 'view_Weeklybrekdown'])->name('view-weekly-breakdown');
    Route::get("mid-week-market-review", [CustomerController::class, 'mid_Week_marketReview'])->name('mid-week-market-review');
    Route::get("monthy-signals-reports", [CustomerController::class, 'monthly_SignalReport'])->name('monthy-signals-reports');
    Route::get("economic-calendar", [CustomerController::class, 'economiccal'])->name('economiccal');
    Route::get("billing", [CustomerController::class, 'billing'])->name('billing');
    Route::get("edit-payment-card", [CustomerController::class, 'edit_paymentcard'])->name('Edit-paymentcard');
    Route::get("all-invoices", [CustomerController::class, 'allinvoices'])->name('allinvoices');
    Route::get("edit-join-telegram", [CustomerController::class, 'edit_Jointelegram'])->name('edit-join-telegram');
    Route::get("edit-books", [CustomerController::class, 'edit_books'])->name('edit-books');
    Route::get("edit-vedios", [CustomerController::class, 'edit_vedios'])->name('edit-vedios');
    Route::get("edit-weekly-breakdown", [CustomerController::class, 'edit_weekly_report'])->name('edit-weekly-breakdown');
    Route::get("edit-mid-weekly-breakdown", [CustomerController::class, 'edit_mid_weekly_report'])->name('edit-mid-weekly-breakdown');
    Route::get("weekly-breakdown", [CustomerController::class, 'weekly_breakdown'])->name('weekly-breakdown');

    Route::get("add-weekly-breakdown", [CustomerController::class, 'add_weekly_breakdown'])->name('add_weekly_breakdown');

    Route::get("add-mid-weekly-breakdown", [CustomerController::class, 'add_mid_weekly_breakdown'])->name('add_mid_weekly_breakdown');
    // for submit
    Route::post("weekly_breakdown_submit", [CustomerController::class, 'weekly_breakdown_submit'])->name('weekly_breakdown_submit');

    Route::get("mid-week-review", [CustomerController::class, 'mid_weekreview'])->name('mid-week-review');
    Route::get("edit-monthly-signals-report", [CustomerController::class, 'edit_monthly_signalsreport'])->name('edit-monthly-signals-report');
    Route::get("terms-policy", [CustomerController::class, 'terms_policy'])->name('terms-policy');


    Route::post("update-profile-submit", [CustomerController::class, 'update_profile_submit'])->name('update_profile_submit');
    Route::post("signal-upload-submit", [CustomerController::class, 'signal_upload_submit'])->name('signal_upload_submit');
    Route::post("upload-submit", [CustomerController::class, 'upload_submit'])->name('upload_submit');
    Route::get("add/{slug}", [CustomerController::class, 'add_record'])->name('add_record');
    Route::get("edit/{slug}/{id}", [CustomerController::class, 'edit_record'])->name('edit_record');
});





