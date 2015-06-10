<?php

class LeaveManagesController extends \BaseController {

	public function postLeaveRequestView()
    {
        $data1 = Leave::with('leave_type', 'user')->where('leave_status','=','pending')->get();
        $returndata = [];
        foreach ($data1 as $k => $v) {
            $id = Helper::simple_encrypt($v->leaves_id);
            $returndata[$k]['leaves_id'] = $v->leaves_id;
            $returndata[$k]['subject'] = $v->subject;
            $returndata[$k]['leave_date'] = $v->leave_date;
            $returndata[$k]['leave_status'] = $v->leave_status;
            $returndata[$k]['leave_name'] = $v->leave_type()->first()->leave_title;
            $returndata[$k]['user_name'] = $v->user->first_name . ' ' . $v->user->last_name;
            $returndata[$k]['edit'] = $id;
            $returndata[$k]['delete'] = $id;
        }

        $data['aaData'] = $returndata;

        return $data;
    }
}