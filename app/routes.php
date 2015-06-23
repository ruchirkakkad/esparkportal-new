<?php

Route::get('/noPermission', ['uses' => 'LayoutController@noPermission']);

Route::group(['before' => 'check_ip'], function () {

    Route::get('/', ['uses' => 'LayoutController@masterView']);


    Route::get('appView', ['uses' => 'LayoutController@appView']);
    Route::get('headerView', ['uses' => 'LayoutController@headerView']);
    Route::get('asideView', ['uses' => 'LayoutController@asideView']);
    Route::get('navView', ['uses' => 'LayoutController@navView']);
    Route::get('headerDataView', ['uses' => 'LayoutController@headerDataView']);


//---------------Authentication
    Route::get('login', ['uses' => 'LoginController@index']);
    Route::get('signup', ['uses' => 'LoginController@signup']);
    Route::post('checklogin', ['uses' => 'LoginController@checklogin']);
    Route::post('usersStore', ['uses' => 'LoginController@store']);
    Route::post('setAngularPermission', ['uses' => 'LoginController@setAngularPermission']);
    Route::get('dashboard', ['uses' => 'LoginController@dashboard']);
    Route::post('checkAuthentication', ['uses' => 'LoginController@checkAuthentication']);
    Route::post('logout', ['uses' => 'LoginController@logout']);
//---------------Authentication ends


    Route::controller('general_modules', 'GeneralModulesController');
    Route::controller('modules', 'ModulesController');
    Route::controller('staffing', 'StaffingController');
    Route::controller('leave_manages', 'LeaveManagesController');
    Route::controller('notifications', 'NotificationsController');

    Route::group(['before' => 'permission'], function () {
//---------------Marketing-----------------
        Route::controller('marketing_countries', 'MarketingCountriesController');
        Route::controller('marketing_states', 'MarketingStatesController');
        Route::controller('marketing_categories', 'MarketingCategoriesController');
        Route::controller('timezones', 'TimezonesController');
        Route::controller('leads_statuses', 'LeadsStatusesController');
        Route::controller('sheets', 'SheetsController');
        Route::controller('marketing_datas', 'MarketingDatasController');
        Route::controller('leads', 'LeadsController');
        Route::controller('followup', 'FollowupController');
        Route::controller('call_closed', 'CallclosedController');
        Route::controller('marketing_report', 'MarketingReportController');
        Route::controller('marketing_calendar', 'MarketingCalendarController');
//---------------Marketing ends--------------------

//---------------HRMS starts--------------------
        Route::controller('users', 'UsersController');
        Route::controller('departments', 'DepartmentsController');
        Route::controller('designations', 'DesignationsController');
        Route::controller('job_profiles', 'JobProfilesController');
        Route::controller('user_profiles', 'UserProfilesController');
        Route::controller('time_tracker', 'TimeTrackerController');
        Route::controller('attendance_chart', 'AttendanceChartController');
        Route::controller('time_log', 'TimeLogController');
        Route::controller('time_sheet', 'TimeSheetController');
        Route::controller('user_wise_time_sheet', 'UserWiseTimeSheetController');
        Route::controller('date_wise_time_sheet', 'DateWiseTimeSheetController');
        Route::controller('skills', 'SkillsController');
        Route::controller('educational_qualifications', 'EducationalQualificationsController');
        Route::controller('languages', 'LanguagesController');

        Route::controller('leave_types', 'LeaveTypesController');
        Route::controller('leaves', 'LeavesController');

        Route::controller('expenses', 'ExpensesController');
        Route::controller('holidays', 'HolidaysController');

        Route::controller('announcements', 'AnnouncementsController');
//---------------HRMS ends--------------------

//---------------Password Management starts--------------------
        Route::controller('password_mgmts', 'PasswordMgmtsController');
//---------------Password Management ends--------------------


//---------------Organization starts--------------------
        Route::controller('company_details', 'CompanyDetailsController');
        Route::controller('work_shifts', 'WorkShiftsController');
        Route::controller('roles', 'RolesController');
        Route::controller('permissions', 'PermissionsController');
        Route::controller('allowed_ips', 'AllowedIpsController');
        Route::controller('user_ip_permission', 'UserIpPermissionController');
//---------------Organization ends--------------------

        Route::controller('recruit_candidates', 'RecruitCandidatesController');

    });
});

Route::get('migrate',function(){
    Artisan::call('migrate');
    echo '<br>done migrate:install';
});
Route::get('fileconvert',function(){
//    CloudConvert::file('/uploads/admin@admin.com/attachments/initial questions of rippled waters.docx')->to('/uploads/admin@admin.com/attachments/t.jpg');

    CloudConvert::file('/uploads/admin@admin.com/attachments/Lighthouse.jpg')->to('png');
});
Route::get('screenshots',function(){
    dd(CloudConvert::file('uploads/admin@admin.com/attachments/t.pdf')->to('jpg'));

//    CloudConvert::website('www.google.com')->to('google.jpg');

});