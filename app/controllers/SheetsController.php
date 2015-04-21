<?php

class SheetsController extends \BaseController {

    public function getIndexView()
    {
        return View::make('sheets.index');
    }

    public function postCountriesCategoriesView()
    {

        $data= MarketingCountry::join('marketing_states','marketing_states.marketing_countries_id','=','marketing_countries.marketing_countries_id')
                            ->join('marketing_datas','marketing_states.marketing_states_id','=','marketing_datas.marketing_states_id')
                            ->where('marketing_countries.marketing_countries_id','=',1)
                            ->groupBy('marketing_countries.marketing_countries_id')->count();
        dd($data);
        $data['countries'] = MarketingCountry::select('marketing_countries_name', 'marketing_countries_id')->get();
        foreach($data['countries'] as $key => $val)
        {
            $data['countries'][$key]->sheets_count = count($val->sheets);
            $data['countries'][$key]->marketing_countries_id = Helper::simple_encrypt($data['countries'][$key]->marketing_countries_id);
        }
        $data['categories'] = MarketingCategory::select('marketing_categories_name', 'marketing_categories_id')->get();
        return json_encode($data);
    }

    public function getCountrySheets()
    {
        return View::make('sheets.country-sheets');
    }
    public function getCountrySheetsdataView($id)
    {
        $id = Helper::simple_decrypt($id);
        $data['aaData'] = Sheet::where('marketing_countries_id','=',$id)->has('user')->get();

        $data1 = Sheet::where('marketing_countries_id','=',$id)->get();
        $returndata = [];
        foreach($data1 as $k => $v)
        {
            $id = Helper::simple_encrypt($v->id);
            $returndata[$k]['id'] = $v->id;
            $returndata[$k]['name'] = $v->user->firstname.'-'.$v->input_date;
            $returndata[$k]['marketing_countries_name'] = $v->country->marketing_countries_name;
            $returndata[$k]['marketing_categories_name'] = $v->category->marketing_categories_name;
            $returndata[$k]['edit'] = "<a href='#/app/marketing_states/edit/$id'><button class='btn m-b-xs btn-sm btn-info'><i class='fa fa-search'></i></button></a>";
            $returndata[$k]['delete'] = "<a href='#/app/marketing_states/delete/$id'><button class='btn btn-sm btn-icon btn-danger'><i class='fa fa-trash-o'></i></button></a>";
        }

        $data['aaData'] = $returndata;

        return $data;
    }

    public function getIndexdataView()
    {
        $data1 = Sheet::has('timezone')->has('country')->get();
        $returndata = [];
        foreach($data1 as $k => $v)
        {
            $id = Helper::simple_encrypt($v->sheets_id);
            $returndata[$k]['sheets_id'] = $v->sheets_id;
            $returndata[$k]['sheets_name'] = $v->sheets_name;
            $returndata[$k]['timezones_name'] = $v->timezone->timezones_name;
            $returndata[$k]['marketing_countries_name'] = $v->country->marketing_countries_name;
            $returndata[$k]['edit'] = "<a href='#/app/sheets/edit/$id'><button class='btn m-b-xs btn-sm btn-primary'><i class='fa fa-edit'></i></button></a>";
            $returndata[$k]['delete'] = "<a href='#/app/sheets/delete/$id'><button class='btn btn-sm btn-icon btn-danger'><i class='fa fa-trash-o'></i></button></a>";
        }

        $data['aaData'] = $returndata;

        return $data;
    }

    public function getCreateAdd()
    {
        return View::make('sheets.create');
    }

    public function postCountriesCategoriesAdd()
    {
        $data['countries'] = MarketingCountry::select('marketing_countries_name', 'marketing_countries_id')->get();
        $data['categories'] = MarketingCategory::select('marketing_categories_name', 'marketing_categories_id')->get();
        return json_encode($data);
    }


    public function postStoreAdd()
    {

        $sheet = new Sheet();
        $sheet->input_date = date('Y-m-d',strtotime(Input::get('input_date')));
        $sheet->marketing_countries_id = Input::get('marketing_countries_id');
        $sheet->marketing_categories_id = Input::get('marketing_categories_id');
        $sheet->user_id = Auth::id();
         $save = $sheet->save();
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.store_record_msg'),
                'result' => null
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('c                                                                                                                                                                                                                                                                                                                                                                                                                              onstants.error_record_msg'),
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
        return View::make('sheets.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data = Sheet::find($id);
        $data->sheets_id = Helper::simple_encrypt($data->sheets_id);
        return Response::json($data);
    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $state = Sheet::find($id);
        $state->sheets_name = Input::get('sheets_name');
        $state->marketing_countries_id = Input::get('marketing_countries_id');
        $state->timezones_id = Input::get('timezones_id');

        $save = $state->save();
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
        $country = Sheet::find($id);

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