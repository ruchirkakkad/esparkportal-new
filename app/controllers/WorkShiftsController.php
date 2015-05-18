<?php

class WorkShiftsController extends \BaseController {
    public function getIndexView()
    {
        return View::make('work_shifts.index');
    }

    public function getIndexdataView()
    {
        $data1 = WorkShift::all();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['work_shifts_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('work_shifts.create');
    }

    public function postStoreAdd()
    {
        $work_shifts = new WorkShift();
        $work_shifts->work_shifts_name = Input::get('work_shifts_name');
        $work_shifts->staffing = date('H:i',strtotime(Input::get('staffing'))).":00";
        $work_shifts->office_start_time = date('H:i',strtotime(Input::get('office_start_time'))).":00";
        $work_shifts->office_end_time = date('H:i',strtotime(Input::get('office_end_time'))).":00";
        $work_shifts->break_start_time = date('H:i',strtotime(Input::get('break_start_time'))).":00";
        $work_shifts->break_end_time = date('H:i',strtotime(Input::get('break_end_time'))).":00";

        $save = $work_shifts->save();
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
        return View::make('work_shifts.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data = WorkShift::find($id);

        $data->work_shifts_id = Helper::simple_encrypt($data->work_shifts_id);

        return Response::json($data);

    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $work_shifts = WorkShift::find($id);
        $work_shifts->work_shifts_name = Input::get('work_shifts_name');
        $work_shifts->staffing = date('H:i',strtotime(Input::get('staffing'))).":00";
        $work_shifts->office_start_time = date('H:i',strtotime(Input::get('office_start_time'))).":00";
        $work_shifts->office_end_time = date('H:i',strtotime(Input::get('office_end_time'))).":00";
        $work_shifts->break_start_time = date('H:i',strtotime(Input::get('break_start_time'))).":00";
        $work_shifts->break_end_time = date('H:i',strtotime(Input::get('break_end_time'))).":00";

        $save = $work_shifts->save();
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
        $work_shifts = WorkShift::find($id);

        $save = $work_shifts->delete();
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
