<?php

/**
 * Created by PhpStorm.
 * User: ruchir
 * Date: 5/18/2015
 * Time: 5:48 PM
 */
class TimeTrackerController extends \BaseController
{
    public function getUserWiseView()
    {
        return View::make('time_tracker.user_wise');
    }

    public function postUsersListView()
    {
        $data1 = User::where('role_id', '!=', 1)->get();
        $data1 = User::all();
        $returndata = [];
        foreach ($data1 as $k => $v) {
            $id = Helper::simple_encrypt($v->user_id);
            $returndata[$k]['user_id'] = $v->user_id;
            $returndata[$k]['user_encryt_id'] = $id;
            $returndata[$k]['first_name'] = $v->first_name;
            $returndata[$k]['last_name'] = $v->last_name;
        }
        $data['users'] = $returndata;
        return $data;
    }

    public function getUserWiseReportView()
    {
        return View::make('time_tracker.user_wise_report');
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
            $user_id = Auth::user()->user_id;
        }
        else
        {
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

    public function getDateWiseView()
    {
        return View::make('time_tracker.date_wise');
    }

    public function postDateWiseReportView()
    {
        $users = User::where('role_id', '!=', 1)->get();
        $users = User::all();
        $date = date('Y-m-d', strtotime(Input::get('date')));

        $returndata = [];
        foreach ($users as $k => $v) {
            $returndata[$k]['user_id'] = $v->user_id;
            $returndata[$k]['first_name'] = $v->first_name;
            $returndata[$k]['last_name'] = $v->last_name;
            $data1 = Staffing::where('users_id', '=', $v->user_id)
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
        }
        $data['staffings'] = $returndata;
        return $data;
    }

    public function getAttendanceChartView()
    {
        return View::make('time_tracker.attendance_chart');
    }

    public function postAttendanceChartReportView()
    {
        $users = User::where('role_id', '!=', 1)->get();
        $users = User::all();
        $month = Input::get('month');
        $year = Input::get('year');
        $first_day_this_month = date("$year-$month-01");
        $last_day_this_month = date("Y-m-t", strtotime($first_day_this_month));
        $last_day_this_month = date("Y-m-d", strtotime($last_day_this_month . ' +1 day'));
        $returndata = [];
        $dateCountArr = [];
        foreach ($users as $k => $v) {
            $returndata[$k]['user_id'] = $v->user_id;
            $returndata[$k]['first_name'] = $v->first_name;
            $returndata[$k]['last_name'] = $v->last_name;
            $count = 0;
            $date = $first_day_this_month;
            while ($date != $last_day_this_month) {
                $today = date("Y-m-d");
                $dateNumber = date("d", strtotime($date));
                if (!isset($dateCountArr[$dateNumber])) {
                    $dateCountArr[$dateNumber] = 0;
                }
                if (strtotime($date) <= strtotime($today)) {
                    $data1 = Staffing::where('users_id', '=', $v->user_id)
                        ->whereRaw("DATE_FORMAT(check_in,'%Y-%m-%d') = '$date'")->get();

                    if (count($data1) == 1) {
                        $returndata[$k]['dates'][$dateNumber]['flag'] = 'P';
                        $count++;
                        $dateCountArr[$dateNumber]++;
                    } else {
                        $returndata[$k]['dates'][$dateNumber]['flag'] = 'A';
                    }
                } else {
                    $returndata[$k]['dates'][$dateNumber]['flag'] = '';
                }
                $next_date = date('Y-m-d', strtotime($date . ' +1 day'));
                $date = $next_date;
            }
            $returndata[$k]['total_present'] = $count;
        }
        $data['staffings'] = $returndata;
        $data['total_present_count_date_wise'] = $dateCountArr;
        return $data;
    }

    public function getEditStaffingEdit()
    {
        return View::make('time_tracker.edit_staffing');
    }

    public function postUserStaffingEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $staffing = Staffing::join('users', 'users.user_id', '=', 'staffings.users_id')
            ->where('staffings_id', '=', $id)->first();
        $data['user_breaks'] = Breaks::where('staffings_id', '=', $id)->select('break_in', 'break_out')->get();
        $data['user_staffing'] = $staffing;
        return $data;
    }

    public function postUpdateStaffingEdit($id,$entryDate)
    {
        $id = Helper::simple_decrypt($id);
        $staffing = Input::get('staffings');
        $breaks = Input::get('breaks');
        $check_in = Helper::date_ymdhis($staffing['check_in']);
        $flag_is_check_out = true;
        $flag_is_break_out = true;
        $error = false;
        $temp_lastbreakout = $check_in;
        $msg = [];
        $alert_msg = [];

        if(date('Y-m-d',strtotime($entryDate)) != date('Y-m-d',strtotime($check_in)))
        {
            $msg[] = "Check in Date does not match with the editing date";
            return json_encode([
                'code' => 403,
                'msg' => $msg,
                'alert_msg' => null
            ]);
        }

        foreach ($breaks as $key => $value) {

            if ($value['break_in'] == '' || $value['break_in'] == '0000-00-00 00:00:00') {
                $msg[] = 'Please enter proper breaks or remove the unwanted';
                $error = true;
                break;
            }
            $break_in = Helper::date_ymdhis($value['break_in']);
            $break_out = Helper::date_ymdhis($value['break_out']);
            if ($break_in < $check_in || $break_in < $temp_lastbreakout) {
                $msg[] = 'Break in time cannot be greater than check in / last break out';
                $error = true;
                break;
            }
            if ($value['break_out'] == '' || $value['break_out'] == '0000-00-00 00:00:00') {
                $alert_msg[] = 'No break out entry inserted.. So check out will not be counted..';
                $flag_is_break_out = false;
                break;
            }
            if ($break_out < $break_in) {
                $msg[] = 'Break out time cannot be greater than break in';
                $error = true;
                break;
            }
            $temp_lastbreakout = $break_out;
        }
        if ($error) {
            return json_encode([
                'code' => 403,
                'msg' => $msg,
                'alert_msg' => null
            ]);
        } else {
            if ($flag_is_break_out) {
                if ($staffing['check_out'] == '' || $staffing['check_out'] == '0000-00-00 00:00:00') {
                    $alert_msg[] = 'No check out entry inserted..';
                    $flag_is_check_out = false;
                }
                if ($flag_is_check_out) {
                    $check_out = Helper::date_ymdhis($staffing['check_out']);
                    if ($check_out < $temp_lastbreakout) {
                        $msg[] = 'Check out time cannot be greater than check in / last break out';
                        $error = true;
                    }
                }
            }
        }
        if ($error) {
            return json_encode([
                'code' => 403,
                'msg' => $msg,
                'alert_msg' => null
            ]);
        } else {
            $check_out = Helper::date_ymdhis($staffing['check_out']);
            if ($flag_is_check_out && $flag_is_break_out) {
                $flag = 'checkedout';
            } else {
                $check_out = '0000-00-00 00:00:00';
                if ($flag_is_break_out) {
                    $flag = 'check';
                } else {
                    $flag = 'break';
                }
            }
            if ($id != 'add') {
                $staffing = Staffing::find($id);
            } else {
                $staffing = new Staffing();
            }

            $staffing->check_in = $check_in;
            $staffing->check_out = $check_out;
            $staffing->flag = $flag;
            $staffing->save();
            Breaks::where('staffings_id', '=', $id)->delete();
            foreach ($breaks as $key => $value) {
                $break_in = Helper::date_ymdhis($value['break_in']);
                $break_out = Helper::date_ymdhis($value['break_out']);
                $break = new Breaks();
                $break->break_in = $break_in;
                $break->staffings_id = $id;
                if ($value['break_out'] == '' || $value['break_out'] == '0000-00-00 00:00:00') {
                    $break->break_out = '0000-00-00 00:00:00';
                    $break->flag = 'breakin';
                    $break->save();
                    break;
                } else {
                    $break->break_out = $break_out;
                    $break->flag = 'breakout';
                    $break->save();
                }
            }
            return json_encode([
                'code' => 200,
                'msg' => 'Updated Successfully..',
                'alert_msg' => $alert_msg
            ]);
        }
    }

    public function getAddStaffingEdit()
    {
        return View::make('time_tracker.add_staffing');
    }

    public function postUserDataEdit($id)
    {
        return User::find($id);
    }
    public function postAddStaffingEdit($entryDate,$user_id)
    {
        $staffing = Input::get('staffings');
        $breaks = Input::get('breaks');
        $check_in = Helper::date_ymdhis($staffing['check_in']);
        $flag_is_check_out = true;
        $flag_is_break_out = true;
        $error = false;
        $temp_lastbreakout = $check_in;
        $msg = [];
        $alert_msg = [];

        if(date('Y-m-d',strtotime($entryDate)) != date('Y-m-d',strtotime($check_in)))
        {
            $msg[] = "Check in Date does not match with the editing date";
            return json_encode([
                'code' => 403,
                'msg' => $msg,
                'alert_msg' => null
            ]);
        }
        foreach ($breaks as $key => $value) {

            if ($value['break_in'] == '' || $value['break_in'] == '0000-00-00 00:00:00') {
                $msg[] = 'Please enter proper breaks or remove the unwanted';
                $error = true;
                break;
            }
            $break_in = Helper::date_ymdhis($value['break_in']);
            $break_out = Helper::date_ymdhis($value['break_out']);
            if ($break_in < $check_in || $break_in < $temp_lastbreakout) {
                $msg[] = 'Break in time cannot be greater than check in / last break out';
                $error = true;
                break;
            }
            if ($value['break_out'] == '' || $value['break_out'] == '0000-00-00 00:00:00') {
                $alert_msg[] = 'No break out entry inserted.. So check out will not be counted..';
                $flag_is_break_out = false;
                break;
            }
            if ($break_out < $break_in) {
                $msg[] = 'Break out time cannot be greater than break in';
                $error = true;
                break;
            }
            $temp_lastbreakout = $break_out;
        }
        if ($error) {
            return json_encode([
                'code' => 403,
                'msg' => $msg,
                'alert_msg' => null
            ]);
        } else {
            if ($flag_is_break_out) {
                if ($staffing['check_out'] == '' || $staffing['check_out'] == '0000-00-00 00:00:00') {
                    $alert_msg[] = 'No check out entry inserted..';
                    $flag_is_check_out = false;
                }
                if ($flag_is_check_out) {
                    $check_out = Helper::date_ymdhis($staffing['check_out']);
                    if ($check_out < $temp_lastbreakout) {
                        $msg[] = 'Check out time cannot be greater than check in / last break out';
                        $error = true;
                    }
                }
            }
        }
        if ($error) {
            return json_encode([
                'code' => 403,
                'msg' => $msg,
                'alert_msg' => null
            ]);
        } else {
            $check_out = Helper::date_ymdhis($staffing['check_out']);
            if ($flag_is_check_out && $flag_is_break_out) {
                $flag = 'checkedout';
            } else {
                $check_out = '0000-00-00 00:00:00';
                if ($flag_is_break_out) {
                    $flag = 'check';
                } else {
                    $flag = 'break';
                }
            }
            $staffing = new Staffing();

            $staffing->check_in = $check_in;
            $staffing->users_id = $user_id;
            $staffing->check_out = $check_out;
            $staffing->flag = $flag;
            $staffing->save();
            $id = $staffing->staffings_id;
            Breaks::where('staffings_id', '=', $id)->delete();
            foreach ($breaks as $key => $value) {
                $break_in = Helper::date_ymdhis($value['break_in']);
                $break_out = Helper::date_ymdhis($value['break_out']);
                $break = new Breaks();
                $break->break_in = $break_in;
                $break->staffings_id = $id;
                if ($value['break_out'] == '' || $value['break_out'] == '0000-00-00 00:00:00') {
                    $break->break_out = '0000-00-00 00:00:00';
                    $break->flag = 'breakin';
                    $break->save();
                    break;
                } else {
                    $break->break_out = $break_out;
                    $break->flag = 'breakout';
                    $break->save();
                }
            }
            return json_encode([
                'code' => 200,
                'msg' => 'Updated Successfully..',
                'alert_msg' => $alert_msg
            ]);
        }
    }


    public function getTimeLogView()
    {
        return View::make('time_tracker.time_log');
    }
}