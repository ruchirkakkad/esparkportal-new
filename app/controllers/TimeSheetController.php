<?php

class TimeSheetController extends \BaseController {

	public function getUserWiseReportView()
	{
		return View::make('time_tracker.user_wise_report_self');
	}

	public function postUsersReportView($id = null)
	{
		$first_day_this_month = date('Y-m-01');
		$last_day_this_month = date('Y-m-t');
		return $this->calculateUserWiseFromDate($id, $first_day_this_month, $last_day_this_month);
	}

	public function postUsersReportMonthYearView($id)
	{
		$year = Input::get('year');
		$month = Input::get('month');
		$first_day_this_month = date("$year-$month-01");
		$last_day_this_month = date("Y-m-t", strtotime($first_day_this_month));
		$last_day_this_month = date("Y-m-d", strtotime($last_day_this_month . ' +1 day'));
		return $this->calculateUserWiseFromDate($id, $first_day_this_month, $last_day_this_month);
	}

	public function postUsersReportDateRangeView($id)
	{
		$inputDate = Input::get('dateRangeSearch');
		$startDate = date("Y-m-d", strtotime($inputDate['startDate']));
		$endDate = date("Y-m-d", strtotime($inputDate['endDate'] . ' +1 day'));
		return $this->calculateUserWiseFromDate($id, $startDate, $endDate);
	}

	private function calculateUserWiseFromDate($user_id, $startDate, $endDate)
	{
		$date = $startDate;
		if($user_id == 'self')
		{
			$do_edit = 0;
			$user_id = Auth::user()->user_id;
		}
		else
		{
			$do_edit = 1;
			$user_id = Helper::simple_decrypt($user_id);
		}
		$data['user'] = User::find($user_id);
		$returndata = [];
		$k = 0;
		while ($date != $endDate) {
			$data1 = Staffing::where('users_id', '=', $user_id)
				->whereRaw("DATE_FORMAT(check_in,'%Y-%m-%d') = '$date'")->get();
			if (count($data1) == 1) {
				$id = Helper::simple_encrypt($data1[0]->staffings_id);
				$returndata[$k]['staffings_id'] = $data1[0]->staffings_id;
				$returndata[$k]['staffings_encrypt_id'] = $id;
				$returndata[$k]['date'] = $date;
				$returndata[$k]['check_in'] = date('M d, H:i', strtotime($data1[0]->check_in));
				$returndata[$k]['check_out'] = date('M d, H:i', strtotime($data1[0]->check_out));
				$returndata[$k]['flag'] = $data1[0]->flag;
				$returndata[$k]['comment'] = $data1[0]->comment;
				$returndata[$k]['total_staffing'] = $this->calculateStaffing($data1[0]->staffings_id, $data1[0]->check_in, $data1[0]->check_out, $data1[0]->flag);
			} else {
				$returndata[$k]['staffings_id'] = '';
				$returndata[$k]['staffings_encrypt_id'] = '';
				$returndata[$k]['date'] = $date;
				$returndata[$k]['check_in'] = '';
				$returndata[$k]['check_out'] = '';
				$returndata[$k]['flag'] = 'absent';
				$returndata[$k]['comment'] = '';
				$returndata[$k]['total_staffing'] = ['time' => '', 'break_time' => '', 'actual_break_time' => ''];
			}
			$returndata[$k]['do_edit'] = $do_edit;
			$k++;
			$next_date = date('Y-m-d', strtotime($date . ' +1 day'));
			$date = $next_date;
		}
		$data['staffings'] = $returndata;
		return $data;
	}

	private function calculateStaffing($staffing_id, $check_in, $check_out, $flag)
	{
		$maxTime = Config::get('constants.maxAllowedTimeForStaffing');
		$minBreak = Config::get('constants.minBreakTimeForStaffing');
		$current_date = date('Y-m-d H:i:s');
		$breaks = Breaks::where("staffings_id", '=', $staffing_id)->get();
		$totalBreaks = 0;
		if (!empty($breaks)) {
			foreach ($breaks as $key => $value) {
				if ($value->break_out == '0000-00-00 00:00:00') {
					$totalStaff = strtotime($value->break_in) - strtotime($check_in);
					$actualBreak = $totalBreaks;
					if ($minBreak > $totalBreaks && $totalBreaks != 0) {
						$totalBreaks = $minBreak;
					}
					$totalTime = (($totalStaff - $totalBreaks) > 0) ? ($totalStaff - $totalBreaks) : 0;
					$totalFromCheckedInTime = strtotime($current_date) - strtotime($check_in);
					if ($totalTime > $maxTime || ($totalFromCheckedInTime > $maxTime && $flag != 'checkedout')) {
						return ['time' => gmdate('H:i', $totalTime), 'break_time' => gmdate('H:i', $totalBreaks), 'actual_break_time' => gmdate('H:i', $actualBreak)];
					} else {
						return ['time' => gmdate('H:i', $totalTime), 'break_time' => gmdate('H:i', $totalBreaks), 'actual_break_time' => gmdate('H:i', $actualBreak)];
					}
				} else {
					$totalBreaks += strtotime($value->break_out) - strtotime($value->break_in);
				}
			}
		}
		if ($flag == 'checkedout') {
			$totalStaff = strtotime($check_out) - strtotime($check_in);
			$actualBreak = $totalBreaks;
			if ($minBreak > $totalBreaks && $totalBreaks != 0) {
				$totalBreaks = $minBreak;
			}
			$totalTime = (($totalStaff - $totalBreaks) > 0) ? ($totalStaff - $totalBreaks) : 0;
			$totalFromCheckedInTime = strtotime($current_date) - strtotime($check_in);
			if ($totalTime > $maxTime || ($totalFromCheckedInTime > $maxTime && $flag != 'checkedout')) {
				return ['time' => gmdate('H:i', $totalTime), 'break_time' => gmdate('H:i', $totalBreaks), 'actual_break_time' => gmdate('H:i', $actualBreak)];
			} else {
				return ['time' => gmdate('H:i', $totalTime), 'break_time' => gmdate('H:i', $totalBreaks), 'actual_break_time' => gmdate('H:i', $actualBreak)];
			}
		} elseif ($flag == 'check') {
			$totalStaff = strtotime($current_date) - strtotime($check_in);
			$actualBreak = $totalBreaks;
			if ($minBreak > $totalBreaks && $totalBreaks != 0) {
				$totalBreaks = $minBreak;
			}
			$totalTime = (($totalStaff - $totalBreaks) > 0) ? ($totalStaff - $totalBreaks) : 0;
			$totalFromCheckedInTime = strtotime($current_date) - strtotime($check_in);
			if ($totalTime > $maxTime || ($totalFromCheckedInTime > $maxTime && $flag != 'checkedout')) {
				return ['time' => gmdate('H:i', $totalTime), 'break_time' => gmdate('H:i', $totalBreaks), 'actual_break_time' => gmdate('H:i', $actualBreak)];
			} else {
				return ['time' => gmdate('H:i', $totalTime), 'break_time' => gmdate('H:i', $totalBreaks), 'actual_break_time' => gmdate('H:i', $actualBreak)];
			}
		} else {
			return ['time' => '00:00', 'break_time' => '00:00'];
		}
	}
}