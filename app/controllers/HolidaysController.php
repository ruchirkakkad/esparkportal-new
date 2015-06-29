<?php

class HolidaysController extends \BaseController {

    public function getIndexView()
    {
        return View::make('holidays.index');
    }

    public function getIndexdataView()
    {
        $data1 = Holiday::orderBy('holidays_date','asc')->get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['holidays_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('holidays.create');
    }

    public function postStoreAdd()
    {
        $holidays = new Holiday();
        $holidays->holidays_name = Input::get('holidays_name');
        $holidays->holidays_date = date('Y-m-d',strtotime(Input::get('holidays_date')));

        $save = $holidays->save();
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
        return View::make('holidays.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data = Holiday::find($id);

        $data->holidays_id = Helper::simple_encrypt($data->holidays_id);

        return Response::json($data);

    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $holidays = Holiday::find($id);
        $holidays->holidays_name = Input::get('holidays_name');
        $holidays->holidays_date = date('Y-m-d',strtotime(Input::get('holidays_date')));

        $save = $holidays->save();
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
        $holidays = Holiday::find($id);

        $save = $holidays->delete();
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
