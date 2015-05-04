<?php

class EducationalQualificationsController extends \BaseController {

    public function getIndexView()
    {
        return View::make('educational_qualifications.index');
    }

    public function getIndexdataView()
    {
        $data1 = EducationalQualification::select('educational_qualifications_id', 'educational_qualifications_name')->get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['educational_qualifications_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('educational_qualifications.create');
    }

    public function postStoreAdd()
    {
        $educational_qualifications = new EducationalQualification();
        $educational_qualifications->educational_qualifications_name = Input::get('educational_qualifications_name');

        $save = $educational_qualifications->save();
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
        return View::make('educational_qualifications.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data = EducationalQualification::find($id);

        $data->educational_qualifications_id = Helper::simple_encrypt($data->educational_qualifications_id);

        return Response::json($data);

    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $educational_qualifications = EducationalQualification::find($id);
        $educational_qualifications->educational_qualifications_name = Input::get('educational_qualifications_name');

        $save = $educational_qualifications->save();
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
        $educational_qualifications = EducationalQualification::find($id);

        $save = $educational_qualifications->delete();
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
