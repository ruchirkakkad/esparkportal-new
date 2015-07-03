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
        $fields = json_decode(json_encode($fields),true);
        foreach($fields as $key => $val)
        {
            $setting_key = $val['key'];
            $setting_key = str_replace('_',' ',$setting_key );
            $setting_key = explode(' ',$setting_key);
            foreach($setting_key as $k => $v)
            {
                $setting_key[$k] = ucfirst($v);
            }
            $setting_key = implode(' ', $setting_key);
            $fields[$key]['title'] = $setting_key;
        }
        return json_decode(json_encode($fields),true);
    }
    public function anyUpdateView()
    {
        $fields = Input::get('fields');
        foreach($fields as $key => $val)
        {
            Setting::where('settings_id','=',$val['settings_id'])->update(['value'=>$val['value']]);
        }
    }
}