<?php

/**
 * Created by PhpStorm.
 * User: ruchir
 * Date: 5/18/2015
 * Time: 5:48 PM
 */
class StaffingController extends \BaseController
{
    public function postStaffingCalculation()
    {
        $user_id = Auth::user()->user_id;
        $current_date = date('Y-m-d');
        $yesturday_date = date('Y-m-d', strtotime("-1 days"));
        $status = Staffing::where('users_id', '=', $user_id)
            ->whereRaw("IF(
            (SELECT COUNT(*) AS co FROM `staffings`
            WHERE `users_id` = '$user_id'
            AND ( DATE_FORMAT(check_in,'%Y-%m-%d') = '$current_date'
            OR (DATE_FORMAT(check_in,'%Y-%m-%d') = '$yesturday_date' AND DATE_FORMAT(check_out,'%Y-%m-%d') = '$current_date')
            OR (DATE_FORMAT(check_in,'%Y-%m-%d') = '$yesturday_date' AND flag != 'checkedout'))
            ) = 1
            ,( DATE_FORMAT(check_in,'%Y-%m-%d') = '$current_date'
            OR (DATE_FORMAT(check_in,'%Y-%m-%d') = '$yesturday_date' AND DATE_FORMAT(check_out,'%Y-%m-%d') = '$current_date')
            OR (DATE_FORMAT(check_in,'%Y-%m-%d') = '$yesturday_date' AND flag != 'checkedout'))
            ,DATE_FORMAT(check_in,'%Y-%m-%d') = '$current_date')")
            ->get();
        $current_date = date('Y-m-d H:i:s');
        if (count($status) == 0) {
            return ['time' => '00:00', 'accessStyle' => 'none'];
        } elseif (count($status) == 1) {
            $maxTime = Config::get('constants.maxAllowedTimeForStaffing');
            $minBreak = Config::get('constants.minBreakTimeForStaffing');

            $check_in = $status[0]->check_in;
            $staffing_id = $status[0]->staffings_id;
            $breaks = Breaks::where("staffings_id", '=', $staffing_id)->get();
            $totalBreaks = 0;
            if (!empty($breaks)) {
                foreach ($breaks as $key => $value) {
                    if ($value->break_out == '0000-00-00 00:00:00') {
                        $totalStaff = strtotime($value->break_in) - strtotime($check_in);
                        if ($minBreak > $totalBreaks && $totalBreaks != 0) {
                            $totalBreaks = $minBreak;
                        }
                        $totalTime = (($totalStaff - $totalBreaks) > 0) ? ($totalStaff - $totalBreaks) : 0;
                        $totalFromCheckedInTime = strtotime($current_date) - strtotime($check_in);
                        if ($totalTime > $maxTime || ($totalFromCheckedInTime > $maxTime && $status[0]->flag != 'checkedout')) {
                            return ['time' => gmdate('H:i', $totalTime), 'accessStyle' => 'block'];
                        } else {
                            return ['time' => gmdate('H:i', $totalTime), 'accessStyle' => 'none'];
                        }

                    } else {
                        $totalBreaks += strtotime($value->break_out) - strtotime($value->break_in);
                    }
                }

            }
            if ($status[0]->flag == 'checkedout') {
                $check_out = $status[0]->check_out;
                $totalStaff = strtotime($check_out) - strtotime($check_in);

                if ($minBreak > $totalBreaks && $totalBreaks != 0) {
                    $totalBreaks = $minBreak;
                }
                $totalTime = (($totalStaff - $totalBreaks) > 0) ? ($totalStaff - $totalBreaks) : 0;
                $totalFromCheckedInTime = strtotime($current_date) - strtotime($check_in);
                if ($totalTime > $maxTime || ($totalFromCheckedInTime > $maxTime && $status[0]->flag != 'checkedout')) {
                    return ['time' => gmdate('H:i', $totalTime), 'accessStyle' => 'block'];
                } else {
                    return ['time' => gmdate('H:i', $totalTime), 'accessStyle' => 'none'];
                }
            } elseif ($status[0]->flag == 'check') {

                $check_in = $status[0]->check_in;
                $current_date = date('Y-m-d H:i:s');

                $totalStaff = strtotime($current_date) - strtotime($check_in);
                if ($minBreak > $totalBreaks && $totalBreaks != 0) {
                    $totalBreaks = $minBreak;
                }
                $totalTime = (($totalStaff - $totalBreaks) > 0) ? ($totalStaff - $totalBreaks) : 0;

                $totalFromCheckedInTime = strtotime($current_date) - strtotime($check_in);
                if ($totalTime > $maxTime || ($totalFromCheckedInTime > $maxTime && $status[0]->flag != 'checkedout')) {
                    return ['time' => gmdate('H:i', $totalTime), 'accessStyle' => 'block'];
                } else {
                    return ['time' => gmdate('H:i', $totalTime), 'accessStyle' => 'none'];
                }
            } else {
                return ['time' => '00:00', 'accessStyle' => 'none'];
            }
        } else {
            return ['time' => '00:00', 'accessStyle' => 'none'];
        }
    }

    public function postDashboardData()
    {
        $user_id = Auth::user()->user_id;
        $current_date = date('Y-m-d');

        $yesturday_date = date('Y-m-d', strtotime("-1 days"));
//        $status = Staffing::where('users_id', '=', $user_id)
////            ->where('flag','!=','checkedout')
//            ->whereRaw("DATE_FORMAT(check_in,'%Y-%m-%d') = '$current_date' OR (DATE_FORMAT(check_in,'%Y-%m-%d') = '$yesturday_date' AND DATE_FORMAT(check_out,'%Y-%m-%d') != '$yesturday_date')")
//            ->get();

        $status = Staffing::where('users_id', '=', $user_id)
            ->whereRaw("IF(
            (SELECT COUNT(*) AS co FROM `staffings`
            WHERE `users_id` = '$user_id'
            AND ( DATE_FORMAT(check_in,'%Y-%m-%d') = '$current_date'
            OR (DATE_FORMAT(check_in,'%Y-%m-%d') = '$yesturday_date' AND DATE_FORMAT(check_out,'%Y-%m-%d') = '$current_date')
            OR (DATE_FORMAT(check_in,'%Y-%m-%d') = '$yesturday_date' AND flag != 'checkedout'))
            ) = 1
            ,( DATE_FORMAT(check_in,'%Y-%m-%d') = '$current_date'
            OR (DATE_FORMAT(check_in,'%Y-%m-%d') = '$yesturday_date' AND DATE_FORMAT(check_out,'%Y-%m-%d') = '$current_date')
            OR (DATE_FORMAT(check_in,'%Y-%m-%d') = '$yesturday_date' AND flag != 'checkedout'))
            ,DATE_FORMAT(check_in,'%Y-%m-%d') = '$current_date')")
            ->get();
//        $queries = DB::getQueryLog();
//        $last_query = end($queries);
//        dd($last_query);
        $buttons = [];
        $buttons = [];
        $entries = [];
        $success = [];
        $error = ['msg' => ""];
        if (count($status) == 0) {
            $buttons[] = ['name' => 'Check In', 'class' => 'btn-success', 'function' => 'check_in()'];
        } elseif (count($status) == 1) {
            $entries[] = ['msg' => 'Check In time is : ' . date('M d, H:i A', strtotime($status[0]->check_in)), 'type' => 'success'];
            $staffing_id = $status[0]->staffings_id;
            $breaks = Breaks::where("staffings_id", '=', $staffing_id)->get();
            foreach ($breaks as $key => $value) {
                $entries[] = ['msg' => 'Break In time is : ' . date('M d, H:i A', strtotime($value->break_in)), 'type' => 'info'];
                if ($value->break_out != '0000-00-00 00:00:00') {
                    $entries[] = ['msg' => 'Break Out time is : ' . date('M d, H:i A', strtotime($value->break_out)), 'type' => 'warning'];
                }
            }
            if ($status[0]->flag == 'check') {
                $buttons[] = ['name' => 'Break In', 'class' => 'btn-info', 'function' => 'break_in()'];
                $buttons[] = ['name' => 'Check Out', 'class' => 'btn-danger', 'function' => 'check_out()'];
            } elseif ($status[0]->flag == 'break') {
                $buttons[] = ['name' => 'Break Out', 'class' => 'btn-warning', 'function' => 'break_out()'];
            } elseif ($status[0]->flag == 'checkedout') {
                $entries[] = ['msg' => 'Check In time is : ' . date('M d, H:i A', strtotime($status[0]->check_out)), 'type' => 'danger'];
                $success = ['msg' => "Your staffing is added successfully... :)", 'type' => 'green'];
                if (date('Y-m-d', strtotime($status[0]->check_in)) != $current_date) {
                    $buttons[] = ['name' => 'Check In', 'class' => 'btn-success', 'function' => 'check_in()'];
                }
            } else {
                $error = ['msg' => "Something is wrong with your Staffing.. Please kindly contact HR", 'type' => 'red'];
            }
        } else {
            $error = ['msg' => "Something is wrong with your Staffing.. Please kindly contact HR", 'type' => 'red'];
        }
        $data['error'] = $error;
        $data['success'] = $success;
        $data['buttons'] = $buttons;
        $data['entries'] = $entries;
        return $data;
    }

    public function postCheckIn()
    {
        $user_id = Auth::user()->user_id;
        $current_date = date('Y-m-d H:i:s');
        $staffing = new Staffing();
        $staffing->users_id = $user_id;
        $staffing->check_in = $current_date;
        $staffing->flag = 'check';
        $staffing->save();
    }

    public function postCheckOut()
    {
        $user_id = Auth::user()->user_id;
        $current_date = date('Y-m-d H:i:s');
        $staffing = Staffing::where('users_id', '=', $user_id)
            ->where('flag', '=', 'check')
            ->update(['check_out' => $current_date, 'flag' => 'checkedout']);;


    }

    public function postBreakIn()
    {
        $user_id = Auth::user()->user_id;
        $staffing_id = Staffing::where('users_id', '=', $user_id)->where('flag', '=', 'check')->latest()->pluck('staffings_id');
        $current_date = date('Y-m-d H:i:s');
        $break = new Breaks();
        $break->staffings_id = $staffing_id;
        $break->break_in = $current_date;
        $break->flag = 'breakin';
        $break->save();

        if ($break) {
            $staffing = Staffing::find($staffing_id);
            $staffing->flag = 'break';
            $staffing->save();
        }
    }

    public function postBreakOut()
    {
        $user_id = Auth::user()->user_id;
        $staffing_id = Staffing::where('users_id', '=', $user_id)->where('flag', '=', 'break')->latest()->pluck('staffings_id');
        $current_date = date('Y-m-d H:i:s');
        $break_id = Breaks::where('staffings_id', '=', $staffing_id)->where('flag', '=', 'breakin')->pluck('breaks_id');
        $break = Breaks::find($break_id);
        $break->break_out = $current_date;
        $break->flag = 'breakout';
        $break->save();
        if ($break) {
            $staffing = Staffing::find($staffing_id);
            $staffing->flag = 'check';
            $staffing->save();
        }

    }

} 