<?php

class MarketingStatesController extends \BaseController {


    public function getIndexView()
    {
        return View::make('marketing_states.index');
    }

    public function getIndexdataView()
    {
        $data1 = MarketingState::has('timezone')->has('country')->get();
        $returndata = [];
        foreach($data1 as $k => $v)
        {
            $id = Helper::simple_encrypt($v->marketing_states_id);
            $returndata[$k]['marketing_states_id'] = $v->marketing_states_id;
            $returndata[$k]['marketing_states_name'] = $v->marketing_states_name;
            $returndata[$k]['timezones_name'] = $v->timezone->timezones_name;
            $returndata[$k]['marketing_countries_name'] = $v->country->marketing_countries_name;
            $returndata[$k]['edit'] = "<a href='#/app/marketing_states/edit/$id'><button class='btn m-b-xs btn-sm btn-primary'><i class='fa fa-edit'></i></button></a>";
            $returndata[$k]['delete'] = "<a href='#/app/marketing_states/delete/$id'><button class='btn btn-sm btn-icon btn-danger'><i class='fa fa-trash-o'></i></button></a>";
        }

        $data['aaData'] = $returndata;

        return $data;
    }

    public function getCreateAdd()
    {
        return View::make('marketing_states.create');
    }

    public function postCountriesTimezonesAdd()
    {
        $data['countries'] = MarketingCountry::select('marketing_countries_name', 'marketing_countries_id')->get();
        $data['timezones'] = Timezone::select('timezones_name', 'timezones_id')->get();
        return json_encode($data);
    }


    public function postStoreAdd()
    {

        $state = new MarketingState();
        $state->marketing_states_name = Input::get('marketing_states_name');
        $state->marketing_countries_id = Input::get('marketing_countries_id');
        $state->timezones_id = Input::get('timezones_id');

        $save = $state->save();
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
        return View::make('marketing_states.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data = MarketingState::find($id);
        $data->marketing_states_id = Helper::simple_encrypt($data->marketing_states_id);
        return Response::json($data);
    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $state = MarketingState::find($id);
        $state->marketing_states_name = Input::get('marketing_states_name');
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
        $country = MarketingState::find($id);

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