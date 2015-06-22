<?php

class LeaveManagesController extends \BaseController
{

    public function getIndexView()
    {
        return View::make('leave_manages.index');
    }
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
        $leave = Leave::find($id);
        $to[0] = new stdClass();
        $to[0]->email = User::find($leave->users_id)->email;
        $to[0]->name = User::find($leave->users_id)->first_name;
        $status_type = Input::get('status_type');
        if ($status_type == 'leave_request') {
            if (Input::get('status')) {
                $status = 'approve';
                $message = 'Your Leave has been approved';
                $this->set($status, $message, $to,$leave->users_id);
            } else {
                $status = 'reject';
                $message = 'Your Leave has been rejected';
                $this->set($status, $message, $to,$leave->users_id);
            }
        }
        if ($status_type == 'report') {
            if (Input::get('status')) {
                $status = 'pending';
                $message = 'Your Leave has been put on hold. Status - Pending';
                $this->set($status, $message, $to,$leave->users_id);
            } else {
                $status = 'final-reject';
            }
        }
        if ($status_type == 'today_leave') {
            if (Input::get('status')) {
                $status = 'final-approve';
            } else {
                $status = 'final-reject';
                $message = 'Your Leave has been cancelled..';
                $this->set($status, $message, $to,$leave->users_id);
            }
        }
        $leave->leave_status = $status;
        $leave->save();
    }

    public function set($status, $message, $to,$user_id)
    {
        Helper::sendMail('emails.leave_manage', ['message' => $message], $to, "Leave Status - " . ucfirst($status));
        $notification = new Notification();
        $notification->subject = "Leave Status - " . ucfirst($status);
        $notification->content = $message;
        $notification->label = 'leave';
        $notification->from = Auth::user()->user_id;
        $notification->save();

        $notification_tos = new NotificationTo();
        $notification_tos->notifications_id = $notification->notifications_id;
        $notification_tos->users_id = $user_id;
        $notification_tos->save();

    }
}