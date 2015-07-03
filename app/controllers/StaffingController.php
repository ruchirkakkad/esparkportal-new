<?php

/**
 * Created by PhpStorm.
 * User: ruchir
 * Date: 5/18/2015
 * Time: 5:48 PM
 */
class StaffingController extends \BaseController
{
    public function getUsercount()
    {
        return User::count();
    }
    public function anyStaffingCalculation()
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
            return Response::json(['time' => '00:00', 'accessStyle' => 'none'])->setCallback(Input::get('callback'));
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
                            return Response::json(['time' => Helper::time_hm($totalTime), 'accessStyle' => 'block'])->setCallback(Input::get('callback'));
                        } else {
                            return Response::json(['time' => Helper::time_hm($totalTime), 'accessStyle' => 'none'])->setCallback(Input::get('callback'));
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
                    return Response::json(['time' => Helper::time_hm($totalTime), 'accessStyle' => 'block'])->setCallback(Input::get('callback'));
                } else {
                    return Response::json(['time' => Helper::time_hm($totalTime), 'accessStyle' => 'none'])->setCallback(Input::get('callback'));
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
                    return Response::json(['time' => Helper::time_hm($totalTime), 'accessStyle' => 'block'])->setCallback(Input::get('callback'));
                } else {
                    return Response::json(['time' => Helper::time_hm($totalTime), 'accessStyle' => 'none'])->setCallback(Input::get('callback'));
                }
            } else {
                return Response::json(['time' => '00:00', 'accessStyle' => 'none'])->setCallback(Input::get('callback'));
            }
        } else {
            return Response::json(['time' => '00:00', 'accessStyle' => 'none'])->setCallback(Input::get('callback'));
        }

    }

    public function postDashboardData()
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

        $comment = 'true';
        $comments = [];
        $buttons = [];
        $entries = [];
        $success = [];
        $error = ['msg' => ""];
        if (count($status) == 0) {
            $buttons[] = ['name' => 'Check In', 'class' => 'btn-success', 'function' => 'check_in()'];
            $comment = 'false';
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
            $comments = json_decode($status[0]->comment,true);
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
                $comment = 'false';
            } else {
                $error = ['msg' => "Something is wrong with your Staffing.. Please kindly contact HR", 'type' => 'red'];
                $comment = 'false';
            }
        } else {
            $error = ['msg' => "Something is wrong with your Staffing.. Please kindly contact HR", 'type' => 'red'];
            $comment = 'false';
        }
        $data['error'] = $error;
        $data['success'] = $success;
        $data['buttons'] = $buttons;
        $data['entries'] = $entries;
        $data['comment'] = $comment;
        $data['comments'] = $comments;
        return $data;
    }

    public function postCheckIn()
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


        if (count($status) == 0) {
            $user_id = Auth::user()->user_id;
            $current_date = date('Y-m-d H:i:s');
            $staffing = new Staffing();
            $staffing->users_id = $user_id;
            $staffing->check_in = $current_date;
            $staffing->flag = 'check';
            $staffing->save();
            return 1;
        } elseif (count($status) == 1) {
            if ($status[0]->flag == 'check') {
                return 0;
            } elseif ($status[0]->flag == 'break') {
                return 0;
            } elseif ($status[0]->flag == 'checkedout') {
                if (date('Y-m-d', strtotime($status[0]->check_in)) != $current_date) {
                    $user_id = Auth::user()->user_id;
                    $current_date = date('Y-m-d H:i:s');
                    $staffing = new Staffing();
                    $staffing->users_id = $user_id;
                    $staffing->check_in = $current_date;
                    $staffing->flag = 'check';
                    $staffing->save();
                    return 1;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function postCheckOut()
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


        if (count($status) == 0) {
            return 0;
        } elseif (count($status) == 1) {
            if ($status[0]->flag == 'check') {
                $user_id = Auth::user()->user_id;
                $current_date = date('Y-m-d H:i:s');
                $staffing = Staffing::where('users_id', '=', $user_id)
                    ->where('flag', '=', 'check')
                    ->update(['check_out' => $current_date, 'flag' => 'checkedout']);;
                return 1;
            } elseif ($status[0]->flag == 'break') {
                return 0;
            } elseif ($status[0]->flag == 'checkedout') {
                return 0;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function postBreakIn()
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


        if (count($status) == 0) {
            return 0;
        } elseif (count($status) == 1) {
            if ($status[0]->flag == 'check') {
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
                return 1;
            } elseif ($status[0]->flag == 'break') {
                return 0;
            } elseif ($status[0]->flag == 'checkedout') {
                return 0;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function postBreakOut()
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


        if (count($status) == 0) {
            return 0;
        } elseif (count($status) == 1) {
            if ($status[0]->flag == 'check') {
                return 0;
            } elseif ($status[0]->flag == 'break') {
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
                return 1;
            } elseif ($status[0]->flag == 'checkedout') {
                return 0;
            } else {
                return 0;
            }
        } else {
            return 0;
        }

    }

    public function postAddComment()
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


        if (count($status) == 0) {
            return 0;
        } elseif (count($status) == 1) {
            if ($status[0]->flag == 'check') {
                $staffings_id = $status[0]['staffings_id'];
                $comment = Input::get('comment');
                $staffing = Staffing::find($staffings_id);
                $old_comments = json_decode($staffing->comment,true);
                $old_comments[] = $comment;
                $staffing->comment = json_encode($old_comments);
                $staffing->save();
                return 1;
            } elseif ($status[0]->flag == 'break') {
                $staffings_id = $status[0]['staffings_id'];
                $comment = Input::get('comment');
                $staffing = Staffing::find($staffings_id);
                $old_comments = json_decode($staffing->comment,true);
                $old_comments[] = $comment;
                $staffing->comment = json_encode($old_comments);
                $staffing->save();
                return 1;
            } elseif ($status[0]->flag == 'checkedout') {
                return 0;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
} 