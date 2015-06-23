<?php

class AttendanceChartController extends \BaseController
{

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
}