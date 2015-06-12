<?php

class LeaveManagesController extends \BaseController
{

    public function postLeaveRequestView()
    {
        $data1 = Leave::with('leave_type', 'user')->where('leave_status', '=', 'pending')
            ->orderBy('leave_date')->get();
        $returndata = [];
        foreach ($data1 as $k => $v) {
            $id = Helper::simple_encrypt($v->leaves_id);
            $returndata[$k]['leaves_id'] = $v->leaves_id;
            $returndata[$k]['description'] = $v->description;
            $returndata[$k]['leave_date'] = $v->leave_date;
            $returndata[$k]['leave_status'] = $v->leave_status;
            $returndata[$k]['leave_name'] = $v->leave_type()->first()->leave_title;
            $returndata[$k]['user_name'] = $v->user->first_name . ' ' . $v->user->last_name;
            $returndata[$k]['approve'] = $id;
            $returndata[$k]['reject'] = $id;
        }

        $data['aaData'] = $returndata;

        return $data;
    }

    public function postLeaveReportView()
    {
        $data1 = Leave::with('leave_type', 'user')->where('leave_status', '=', 'approve')
            ->orWhere('leave_status', '=', 'reject')->orderBy('leave_date')->get();
        $returndata = [];
        foreach ($data1 as $k => $v) {
            $id = Helper::simple_encrypt($v->leaves_id);
            $returndata[$k]['leaves_id'] = $v->leaves_id;
            $returndata[$k]['description'] = $v->description;
            $returndata[$k]['leave_date'] = $v->leave_date;
            $returndata[$k]['leave_status'] = $v->leave_status;
            $returndata[$k]['leave_name'] = $v->leave_type()->first()->leave_title;
            $returndata[$k]['user_name'] = $v->user->first_name . ' ' . $v->user->last_name;
            $returndata[$k]['approve'] = $id;
            $returndata[$k]['reject'] = $id;
        }

        $data['aaData'] = $returndata;

        return $data;
    }


    public function postTodayLeaveView()
    {
        $data1 = Leave::with('leave_type', 'user')->where('leave_status', '=', 'approve')
            ->where('leave_date', '=', date('Y-m-d'))->orderBy('leave_date')->get();
        $returndata = [];
        foreach ($data1 as $k => $v) {
            $id = Helper::simple_encrypt($v->leaves_id);
            $returndata[$k]['leaves_id'] = $v->leaves_id;
            $returndata[$k]['description'] = $v->description;
            $returndata[$k]['leave_date'] = $v->leave_date;
            $returndata[$k]['leave_status'] = $v->leave_status;
            $returndata[$k]['leave_name'] = $v->leave_type()->first()->leave_title;
            $returndata[$k]['user_name'] = $v->user->first_name . ' ' . $v->user->last_name;
            $returndata[$k]['approve'] = $id;
            $returndata[$k]['reject'] = $id;
        }

        $data['aaData'] = $returndata;

        return $data;
    }

    public function postLeaveChangeStatus()
    {
        $id = Helper::simple_decrypt(Input::get('id'));
        $status_type = Input::get('status_type');
        if ($status_type == 'leave_request') {
            if (Input::get('status')) {
                $status = 'approve';
            } else {
                $status = 'reject';
            }
        }
        if ($status_type == 'report') {
            if (Input::get('status')) {
                $status = 'pending';
            } else {
                $status = 'final-reject';
            }
        }
        if ($status_type == 'today_leave') {
            if (Input::get('status')) {
                $status = 'final-approve';
            } else {
                $status = 'final-reject';
            }
        }
        $leave = Leave::find($id);
        $leave->leave_status = $status;
        $leave->save();
    }
}