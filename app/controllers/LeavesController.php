<?php

class LeavesController extends \BaseController
{


    public function getIndexView()
    {
        return View::make('leaves.index');
    }

    public function getIndexdataView()
    {

        $data1 = Leave::with('leave_type', 'user')->where('users_id', '=', Auth::user()->user_id)->get();
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

    public function getCreateAdd()
    {
        return View::make('leaves.create');
    }

    public function getLeaveTypesAdd()
    {
        return LeaveType::select('leave_types_id', 'leave_title')->get();
    }

    public function postStoreAdd()
    {
        $leave_date = Input::get('leave_date');
        $startDate = Helper::date_ymdhis($leave_date['startDate']);
        $endDate = Helper::date_ymdhis($leave_date['endDate']);
        while($startDate<=$endDate)
        {
            $leave = new Leave();
            $leave->users_id = Auth::user()->user_id;
            $leave->subject = Input::get('subject');
            $leave->leave_types_id = Input::get('leave_types_id');
            $leave->leave_date = Helper::date_ymdhis($startDate);
            $leave->description = Input::get('description');
            $save = $leave->save();
            $startDate = date('Y-m-d H:i:s',strtotime($startDate.'+1 day'));
        }
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.store_record_msg'),
                'result' => null
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function getEditEdit()
    {
        return View::make('leaves.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data = Leave::find($id);

        $data->leaves_id = Helper::simple_encrypt($data->leaves_id);

        return Response::json($data);

    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $leave = Leave::find($id);
        $leave->leaves_name = Input::get('leaves_name');

        $save = $leave->save();
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.update_record_msg'),
                'result' => null
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null
            ]);
        }
    }


    public function getDestroyDelete($id)
    {
//        return Request::segment(2);
        $id = Helper::simple_decrypt($id);
        $leave = Leave::find($id);

        $save = $leave->delete();
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.delete_record_msg'),
                'result' => null
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null
            ]);
        }
    }


}
