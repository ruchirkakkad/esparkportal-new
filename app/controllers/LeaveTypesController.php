<?php

class LeaveTypesController extends \BaseController {

    public function getIndexView()
    {
        return View::make('leave_types.index');
    }

    public function getIndexdataView()
    {
        $data1 = LeaveType::get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['leave_types_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('leave_types.create');
    }

    public function postStoreAdd()
    {
        $leave_types = new LeaveType();
        $leave_types->leave_name = Input::get('leave_name');
        $leave_types->leave_title = Input::get('leave_title');
        $leave_types->leave_comment = Input::get('leave_comment');
        $leave_types->start_duration = Input::get('start_duration');
        $leave_types->total_leaves = Input::get('total_leaves');
        $leave_types->total_leaves_type = Input::get('total_leaves_type');

        $save = $leave_types->save();
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
        return View::make('leave_types.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data = LeaveType::find($id);
        $data->leave_types_id = Helper::simple_encrypt($data->leave_types_id);
        return Response::json($data);
    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $leave_types = LeaveType::find($id);
        $leave_types->leave_name = Input::get('leave_name');
        $leave_types->leave_title = Input::get('leave_title');
        $leave_types->leave_comment = Input::get('leave_comment');
        $leave_types->start_duration = Input::get('start_duration');
        $leave_types->total_leaves = Input::get('total_leaves');
        $leave_types->total_leaves_type = Input::get('total_leaves_type');

        $save = $leave_types->save();
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
        $id = Helper::simple_decrypt($id);
        $leave_types = LeaveType::find($id);

        $save = $leave_types->delete();
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
