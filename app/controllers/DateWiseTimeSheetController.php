<?php

class DateWiseTimeSheetController extends \BaseController {

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
                if($data1[0]->check_out == '0000-00-00 00:00:00') {
                    $returndata[$k]['check_out'] = '';
                }
                else {
                    $returndata[$k]['check_out'] = date('M d, H:i', strtotime($data1[0]->check_out));
                }
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
                        return ['time' => Helper::time_hm($totalTime), 'break_time' => Helper::time_hm($totalBreaks), 'actual_break_time' => Helper::time_hm($actualBreak)];
                    } else {
                        return ['time' => Helper::time_hm($totalTime), 'break_time' => Helper::time_hm($totalBreaks), 'actual_break_time' => Helper::time_hm($actualBreak)];
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
                return ['time' => Helper::time_hm($totalTime), 'break_time' => Helper::time_hm($totalBreaks), 'actual_break_time' => Helper::time_hm($actualBreak)];
            } else {
                return ['time' => Helper::time_hm($totalTime), 'break_time' => Helper::time_hm($totalBreaks), 'actual_break_time' => Helper::time_hm($actualBreak)];
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
                return ['time' => Helper::time_hm($totalTime), 'break_time' => Helper::time_hm($totalBreaks), 'actual_break_time' => Helper::time_hm($actualBreak)];
            } else {
                return ['time' => Helper::time_hm($totalTime), 'break_time' => Helper::time_hm($totalBreaks), 'actual_break_time' => Helper::time_hm($actualBreak)];
            }
        } else {
            return ['time' => '00:00', 'break_time' => '00:00'];
        }
    }























    public function getEditStaffingEdit()
    {
        return View::make('time_tracker.edit_staffing_date_wise');
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
        return View::make('time_tracker.add_staffing_date_wise');
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
            $staffing->comment = '';
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
}
