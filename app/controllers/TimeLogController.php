<?php

class TimeLogController extends \BaseController {

	public function getTimeLogView()
	{
		return View::make('time_tracker.time_log');
	}

}