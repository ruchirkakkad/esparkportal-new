<?php

class PermissionsController extends \BaseController
{


    public function getIndexView()
    {
        return View::make('permissions.index');
    }

    public function postIndexdataView()
    {

        $data1 = Role::select('id', 'name')->get();
        $data['roles'] = $data1;


        return json_decode(json_encode($data), true);


    }


    public function postSavePermissionView()
    {
        $role_id =  Input::get('role_id');

       $modules_new = Input::all();


        foreach ($modules_new['data'] as $key1 => $value1) {

            foreach ($value1['children'] as $key2 => $value2) {

                foreach ($value2['children'] as $key3 => $value3) {
                    if (isset($value3['children'])) {

                        foreach ($value3['children'] as $key4 => $value4) {

                            if (isset($value4['selected']) && $value4['selected'] == '1') {
                                $checked[$value3['value']][$value4['label']] = 1;
                            } else {
                                $checked[$value3['value']][$value4['label']] =0;
                            }
                        }

                    } else {


                        if (isset($value3['selected']) && $value3['selected'] == '1') {
                            $checked[$value2['value']][$value3['label']] = 1;
                        } else {
                            $checked[$value2['value']][$value3['label']] = 0;
                        }

                    }
                }
            }

        }


        Permission::where('role_id','=',$role_id)->delete();

        foreach($checked as $key => $value)
        {
            $permission = new Permission;
            $permission->role_id = $role_id;
            $permission->page_id = $key;
            $permission->add = $value['add'];
            $permission->view = $value['view'];
            $permission->edit = $value['edit'];
            $permission->delete = $value['delete'];
            $permission->csv = $value['csv'];

            $permission->save();
        }
        return json_encode([
            'code' => 200,
            'msg' => Config::get('constants.store_record_msg'),
            'result' => null
        ]);
    }

    public function postSelectRoleView()
    {
        $role_id=Input::get('role_id');
        $permission=Permission::where('role_id','=',$role_id)->get()->keyBy('page_id')->toArray();


        $modules = array();

        $first_level = Module::where('parent_id', '=', 0)->get();
        foreach ($first_level as $key1 => $value1) {
            $modules[$key1]['label'] = $value1['module_name'];
            $modules[$key1]['value'] = $value1['module_id'];
            $modules[$key1]['children'] = array();

            $second_level = Module::where('parent_id', '=', $value1['module_id'])->get();
            foreach ($second_level as $key2 => $value2) {

                $modules[$key1]['children'][$key2]['label'] = $value2['module_name'];
                $modules[$key1]['children'][$key2]['value'] = $value2['module_id'];
                $third_level = Module::where('parent_id', '=', $value2['module_id'])->get();
//
                if (count($third_level) > 0) {
                    $modules[$key1]['children'][$key2]['children'] = array();

                    foreach ($third_level as $key3 => $value3) {

                        $modules[$key1]['children'][$key2]['children'][$key3]['label'] = $value3['module_name'];
                        $modules[$key1]['children'][$key2]['children'][$key3]['value'] = $value3['module_id'];

                        $modules[$key1]['children'][$key2]['children'][$key3]['children'][0]['label'] = "add";


                        $modules[$key1]['children'][$key2]['children'][$key3]['children'][1]['label'] = "edit";

                        $modules[$key1]['children'][$key2]['children'][$key3]['children'][2]['label'] = "delete";

                        $modules[$key1]['children'][$key2]['children'][$key3]['children'][3]['label'] = "view";

                        $modules[$key1]['children'][$key2]['children'][$key3]['children'][4]['label'] = "csv";
                        if(!empty($permission)&&isset($permission[$value3['module_id']])){
                            $modules[$key1]['children'][$key2]['children'][$key3]['children'][0]['selected'] =($permission[$value3['module_id']]['add'])?true:false;
                            $modules[$key1]['children'][$key2]['children'][$key3]['children'][1]['selected'] =($permission[$value3['module_id']]['edit'])?true:false;
                            $modules[$key1]['children'][$key2]['children'][$key3]['children'][2]['selected'] =($permission[$value3['module_id']]['delete'])?true:false;
                            $modules[$key1]['children'][$key2]['children'][$key3]['children'][3]['selected'] =($permission[$value3['module_id']]['view'])?true:false;
                            $modules[$key1]['children'][$key2]['children'][$key3]['children'][4]['selected'] =($permission[$value3['module_id']]['csv'])?true:false;

                        }

                    }

                } else {
                    $modules[$key1]['children'][$key2]['children'][0]['label'] = "add";

                    $modules[$key1]['children'][$key2]['children'][1]['label'] = "edit";

                    $modules[$key1]['children'][$key2]['children'][2]['label'] = "delete";

                    $modules[$key1]['children'][$key2]['children'][3]['label'] = "view";

                    $modules[$key1]['children'][$key2]['children'][4]['label'] = "csv";
                    if(!empty($permission)&&isset($permission[$value2['module_id']])){
                        $modules[$key1]['children'][$key2]['children'][0]['selected'] =($permission[$value2['module_id']]['add'])?true:false;
                        $modules[$key1]['children'][$key2]['children'][1]['selected'] =($permission[$value2['module_id']]['edit'])?true:false;
                        $modules[$key1]['children'][$key2]['children'][2]['selected'] =($permission[$value2['module_id']]['delete'])?true:false;
                        $modules[$key1]['children'][$key2]['children'][3]['selected'] =($permission[$value2['module_id']]['view'])?true:false;
                        $modules[$key1]['children'][$key2]['children'][4]['selected'] =($permission[$value2['module_id']]['csv'])?true:false;
                    }

                }

            }

        }
        $data['modules'] = $modules;
        return json_decode(json_encode($data), true);
    }

    public function getCreateAdd()
    {
        return View::make('permissions.create');
    }

    public function postStoreAdd()
    {
        $country = new Permission();
        $country->name = Input::get('name');

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
        return View::make('permissions.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data = Permission::find($id);
        $data->id = Helper::simple_encrypt($data->id);
        return Response::json($data);
    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $country = Permission::find($id);
        $country->name = Input::get('name');

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
        $country = Permission::find($id);

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