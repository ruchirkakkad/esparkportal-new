<?php

class LanguagesController extends \BaseController {

    public function getIndexView()
    {
        return View::make('languages.index');
    }

    public function getIndexdataView()
    {
        $data1 = Language::select('languages_id', 'languages_name')->get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['languages_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('languages.create');
    }

    public function postStoreAdd()
    {
        $languages = new Language();
        $languages->languages_name = Input::get('languages_name');

        $save = $languages->save();
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
        return View::make('languages.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data = Language::find($id);

        $data->languages_id = Helper::simple_encrypt($data->languages_id);

        return Response::json($data);

    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $languages = Language::find($id);
        $languages->languages_name = Input::get('languages_name');

        $save = $languages->save();
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
        $languages = Language::find($id);

        $save = $languages->delete();
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
