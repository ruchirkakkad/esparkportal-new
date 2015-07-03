<?php

class SettingsController extends \BaseController
{


    public function getIndexView()
    {
        return View::make('settings.index');
    }

    public function anyIndexDataView()
    {
        $fields = Setting::where('group','=','general_settings')->get();
        return json_decode(json_encode($fields),true);
    }
}