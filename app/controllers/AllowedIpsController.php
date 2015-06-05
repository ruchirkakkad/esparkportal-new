<?php

class AllowedIpsController extends \BaseController {

    public function getIndexView()
    {
        return View::make('allowed_ips.index');
    }

    public function getIndexdataView()
    {
        $data1 = AllowedIp::select('allowed_ips_id', 'allowed_ips_name')->get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['allowed_ips_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('allowed_ips.create');
    }

    public function postStoreAdd()
    {
        $allowed_ips = new AllowedIp();
        $allowed_ips->allowed_ips_name = Input::get('allowed_ips_name');

        $save = $allowed_ips->save();
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
        return View::make('allowed_ips.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data = AllowedIp::find($id);

        $data->allowed_ips_id = Helper::simple_encrypt($data->allowed_ips_id);

        return Response::json($data);

    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $allowed_ips = AllowedIp::find($id);
        $allowed_ips->allowed_ips_name = Input::get('allowed_ips_name');

        $save = $allowed_ips->save();
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
        $allowed_ips = AllowedIp::find($id);

        $save = $allowed_ips->delete();
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
