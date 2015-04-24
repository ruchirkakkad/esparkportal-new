<?php

class LeadsStatusesController extends \BaseController {


    public function getIndexView()
    {
        return View::make('leads_statuses.index');
    }

    public function getIndexdataView()
    {
        $data1 = LeadsStatus::select('leads_statuses_id', 'leads_statuses_name')->get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['leads_statuses_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('leads_statuses.create');
    }

    public function postStoreAdd()
    {
        $status = new LeadsStatus();
        $status->leads_statuses_name = Input::get('leads_statuses_name');

        $save = $status->save();
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
        return View::make('leads_statuses.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data = LeadsStatus::find($id);
        $data->leads_statuses_id = Helper::simple_encrypt($data->leads_statuses_id);
        return Response::json($data);
    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $country = LeadsStatus::find($id);
        $country->leads_statuses_name = Input::get('leads_statuses_name');

        $save = $country->save();
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
        $country = LeadsStatus::find($id);

        $save = $country->delete();
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