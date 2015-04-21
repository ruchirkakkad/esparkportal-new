<?php

class MarketingCategoriesController extends \BaseController {


    public function getIndexView()
    {
        return View::make('marketing_categories.index');
    }

    public function getIndexdataView()
    {
        $data1 = MarketingCategory::select('marketing_categories_id', 'marketing_categories_name')->get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['marketing_categories_id']);
                $returndata[$key][$key1]['edit'] = "<a href='#/app/marketing_categories/edit/$id'><button class='btn m-b-xs btn-sm btn-primary'><i class='fa fa-edit'></i></button></a>";
                $returndata[$key][$key1]['delete'] = "<a href='#/app/marketing_categories/delete/$id'><button class='btn btn-sm btn-icon btn-danger'><i class='fa fa-trash-o'></i></button></a>";
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('marketing_categories.create');
    }

    public function postStoreAdd()
    {
        $country = new MarketingCategory();
        $country->marketing_categories_name = Input::get('marketing_categories_name');

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
        return View::make('marketing_categories.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data = MarketingCategory::find($id);
        $data->marketing_categories_id = Helper::simple_encrypt($data->marketing_categories_id);
        return Response::json($data);
    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $country = MarketingCategory::find($id);
        $country->marketing_categories_name = Input::get('marketing_categories_name');

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
        $country = MarketingCategory::find($id);

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