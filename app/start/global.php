<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

Event::listen('cron.collectJobs', function() {
    Cron::add('example1', '* * * * *', function() {

       return Mail::send('emails.auth.reminder', [], function($message)
        {
            $message->to('webdeveloper1011@gmail.com', 'Ruchir')->subject('Welcome!');
        });
    });



//    Cron::add('Add Leaves', '0 0 1 * *', function() {
    Cron::add('Add Leaves', '* 12 15 * *', function() {

        $users = User::all();

        $leavesType = LeaveType::all();
        foreach($users as $user)
        {

            $user_leave_counter = json_decode($user->leaves_counter,true);

            foreach($leavesType as $leave)
            {
//                var_dump($leave->leave_title);
                if(!isset($user_leave_counter[$leave->leave_title]) || $user_leave_counter[$leave->leave_title] == null)
                {
                    $user_leave_counter[$leave->leave_title] = 0;
                }
//                var_dump($user_leave_counter[$leave->leave_title]);

                if(date('Y-m-d',strtotime($user->doj."+$leave->start_duration months")) <= date('Y-m-d'))
                {
                    var_dump($user->first_name."- $leave->leave_title");
                    $user_leave_counter[$leave->leave_title] = $user_leave_counter[$leave->leave_title] + $leave->total_leaves;
                }
//                var_dump($user->doj."  $leave->start_duration");
//                var_dump(date('Y-m-d',strtotime($user->doj."+$leave->start_duration months")));
            }
            var_dump(json_encode($user_leave_counter));
            echo '<hr>';
//            User::where('user_id', '=', $user->user_id)->update(array('leaves_counter' => json_encode($user_leave_counter)));
        }

    });

    Cron::setDisablePreventOverlapping();
});
//Cron script on server - command as below for every minute
//wget http://eportal.esparkbiz.com/cron.php?key=es4g63dGTiuQeuTsz4PqJ9K3ydJhoUxV
