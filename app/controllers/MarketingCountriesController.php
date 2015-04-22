<?php

class MarketingCountriesController extends \BaseController
{


    public function getIndexView()
    {
        return View::make('marketing_countries.index');
    }

    public function getIndexdataView()
    {
        $data1 = MarketingCountry::select('marketing_countries_id', 'marketing_countries_name')->get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['marketing_countries_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            } 

        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('marketing_countries.create');
    }

    public function postStoreAdd()
    {
        $country = new MarketingCountry();
        $country->marketing_countries_name = Input::get('marketing_countries_name');

        $save = $country->save();
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
        return View::make('marketing_countries.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data = MarketingCountry::find($id);
        $data->marketing_countries_id = Helper::simple_encrypt($data->marketing_countries_id);
        return Response::json($data);
    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $country = MarketingCountry::find($id);
        $country->marketing_countries_name = Input::get('marketing_countries_name');

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
        $country = MarketingCountry::find($id);

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