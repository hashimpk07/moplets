<?php

	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register all of the routes for an application.
	| It's a breeze. Simply tell Laravel the URIs it should respond to
	| and give it the controller to call when that URI is requested.
	|
	*/

	//REWRITE ANY TO GET / POST

	//Login
	Route::any('auth/login', 'LoginController@index' );
	Route::any('auth/login/logout', 'LoginController@logout' );
	Route::any('auth/login/onsubmit', 'LoginController@onSubmit' );

	Route::any( 'ajax/options/{arg}', 'AjaxController@options' );
	Route::any( 'ajax/clickedit', 'AjaxController@clickedit' );

	Route::get( 'home', 'DashboardController@index' );
	Route::get( '/', 'DashboardController@index' );

	Route::controllers( [
		'auth'     => 'Auth\AuthController',
	] );
	Route::any( 'schedule', 'SchedulerController@schedule' );
	Route::any( 'dtmf', 'SchedulerController@dtmf' );
	Route::any( 'api_request', 'SchedulerController@api_request' );

	Route::any( 'profile', 'ProfileController@view' );

	/*  Starting  Branch Master         */

	Route::any( 'branch', 'BranchController@index' );
	Route::any( 'branch/page', 'BranchController@page' );
	Route::any( 'branch/listtable', 'BranchController@listtable' );
	Route::any( 'branch/unblock/{id}', 'BranchController@unblock' );
	Route::any( 'branch/block/{id}', 'BranchController@block' );

	/*  Starting  Region Master         */
	Route::any( 'region', 'RegionController@index' );
	Route::any( 'region/page', 'RegionController@page' );
	Route::any( 'region/listtable', 'RegionController@listtable' );
	Route::any( 'region/unblock/{id}', 'RegionController@unblock' );
	Route::any( 'region/block/{id}', 'RegionController@block' );

	/*  Starting  Location Master         */
	Route::any( 'location', 'LocationController@index' );
	Route::any( 'location/page', 'LocationController@page' );
	Route::any( 'location/listtable', 'LocationController@listtable' );
	Route::any( 'location/unblock/{id}', 'LocationController@unblock' );
	Route::any( 'location/block/{id}', 'LocationController@block' );

	/*  Starting  Settings Master         */
	Route::any( 'settings', 'SettingsController@index' );
	Route::any( 'settings/page', 'SettingsController@page' );
	Route::any( 'settings/onBrandingGeneral', 'SettingsController@onBrandingGeneral' );
	Route::any( 'settings/onBrandingModules', 'SettingsController@onBrandingModules' );
    Route::any( 'settings/onParameterIvr', 'SettingsController@onParameterIvr' );
	Route::any( 'settings/onApiIncome', 'SettingsController@onApiIncome' );
	Route::any( 'settings/onApiCall', 'SettingsController@onApiCall' );
	Route::any( 'settings/onParameterCallPermitted', 'SettingsController@onParameterCallPermitted' );
	Route::any( 'settings/onUrlPath', 'SettingsController@onUrlPath' );


    /*   Starting Excecutive Master                   */
	Route::any( 'executive', 'ExecutiveController@index' );
	Route::any( 'executive/page', 'ExecutiveController@page' );
	Route::any( 'executive/listtable', 'ExecutiveController@listtable' );
	Route::any( 'executive/add', 'ExecutiveController@add' );
	Route::any( 'executive/onAdd', 'ExecutiveController@onAdd' );
	Route::any( 'executive/edit/{id}', 'ExecutiveController@edit' );
	Route::any( 'executive/onEdit/{id}', 'ExecutiveController@onEdit' );
	Route::any( 'executive/unblock/{id}', 'ExecutiveController@unblock' );
	Route::any( 'executive/block/{id}', 'ExecutiveController@block' );
	Route::any( 'executive/view/{id}', 'ExecutiveController@view' );

	/*code for employees starts here*/
	Route::any( 'employees', 'EmployeeController@index' );
	Route::any( 'employees/page', 'EmployeeController@page' );
	Route::any( 'employees/listtable', 'EmployeeController@listtable' );
	Route::any( 'employees/add', 'EmployeeController@add' );
	Route::any( 'employees/onAdd', 'EmployeeController@onAdd' );
	Route::any( 'employees/view/{id}', 'EmployeeController@view' );
	Route::any( 'employees/edit/{id}', 'EmployeeController@edit' );
	Route::any( 'employees/onEdit/{id}', 'EmployeeController@onEdit' );
	Route::any( 'employees/delete/{id}', 'EmployeeController@delete' );
	Route::any( 'employees/block/{id}', 'EmployeeController@block' );

   /*code for reports starts here */
	Route::any( 'reports', 'ReportController@index' );
	Route::any( 'reports/page', 'ReportController@page' );
	Route::any( 'reports/listtable', 'ReportController@listtable' );
	Route::any( 'reports/export', 'ReportController@export' );
	Route::any( 'reports/add', 'ReportController@add' );
	Route::any( 'reports/onAdd', 'ReportController@onAdd' );
	Route::any( 'reports/view/{id}', 'ReportController@view' );
	Route::any( 'reports/edit/{id}', 'ReportController@edit' );
	Route::any( 'reports/onEdit/{id}', 'ReportController@onEdit' );
	Route::any( 'reports/delete/{id}', 'ReportController@delete' );
	Route::any( 'reports/block/{id}', 'ReportController@block' );
	Route::any( 'export_csv_report', 'ReportController@export_csv_report' );

	/*code for dashboard starts here */
	Route::any( 'dashboard', 'DashboardController@index' );
	Route::any( 'dashboard/page', 'DashboardController@page' );
	Route::any( 'dashboard/listtable', 'DashboardController@listtable' );
	Route::any( 'dashboard/add', 'DashboardController@add' );
	Route::any( 'dashboard/onAdd', 'DashboardController@onAdd' );
	Route::any( 'dashboard/view/{id}', 'DashboardController@view' );
	Route::any( 'dashboard/edit/{id}', 'DashboardController@edit' );
	Route::any( 'dashboard/onEdit/{id}', 'DashboardController@onEdit' );
	Route::any( 'dashboard/delete/{id}', 'DashboardController@delete' );
	Route::any( 'dashboard/block/{id}', 'DashboardController@block' );

	/*code for dashboard starts here */
	Route::any( 'comparison', 'ComparisonController@index' );
	Route::any( 'comparison/page', 'ComparisonController@page' );
	Route::any( 'comparison/listtable', 'ComparisonController@listtable' );
	Route::any( 'comparison/add', 'ComparisonController@add' );
	Route::any( 'comparison/onAdd', 'ComparisonController@onAdd' );
	Route::any( 'comparison/view/{id}', 'ComparisonController@view' );
	Route::any( 'comparison/edit/{id}', 'ComparisonController@edit' );
	Route::any( 'comparison/onEdit/{id}', 'ComparisonController@onEdit' );
	Route::any( 'comparison/delete/{id}', 'ComparisonController@delete' );
	Route::any( 'comparison/block/{id}', 'ComparisonController@block' );

	/* Password Change                      */
	Route::any( 'password', 'PasswordController@index' );
	Route::any( 'password/view/{id}', 'PasswordController@view' );
	Route::any( 'password/edit/{id}', 'PasswordController@edit' );
	Route::any( 'password/onEdit/{id}', 'PasswordController@onEdit' );


	/* History    Start Here                              */
	Route::any( 'history', 'HistoryController@index' );
	Route::any( 'history/page', 'HistoryController@page' );
	Route::any( 'history/listtable', 'HistoryController@listtable' );
	Route::any( 'history/addToHistory/{data,id}', 'HistoryController@addToHistory' );
	Route::any( 'history/clear/{id}', 'HistoryController@clear' );
	Route::any( 'history/delete', 'HistoryController@delete' );

