<?php

class ModulesController extends \BaseController
{


    public function getIndex()
    {
        return View::make('modules.index');
    }

    public function getIndexdata()
    {
        $a = Module::select('module_id', 'module_name', 'parent_id', 'module_url', 'is_active', 'is_inmenu')->get();
        $abc['aaData'] = $a;
        $returndata = json_decode(json_encode($abc), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['module_id']);
                $returndata[$key][$key1]['edit'] = "<a href='#/app/modules/edit/$id'><button class='btn m-b-xs btn-sm btn-primary'><i class='fa fa-edit'></i></button></a>";
                $returndata[$key][$key1]['delete'] = "<a href='#/app/modules/delete/$id'><button class='btn btn-sm btn-icon btn-danger'><i class='fa fa-trash-o'></i></button></a>";
//                $returndata[$key][$key1]['delete'] = "<a href='#/app/modules/delete/$val1[module_id]'><button class='btn btn-sm btn-icon btn-danger'><i class='fa fa-trash-o'></i></button></a>";
            }

        }
        return $returndata;
//        return json_encode($arr);
//        return str_replace('"',"'",json_encode(Module::select('module_id','module_name','parent_id','module_url','is_active','is_inmenu')->get()));

    }

    public function postParentdata()
    {
        return json_encode(Module::select('module_name', 'module_id')->get());
    }


    public function getCreate()
    {
        return View::make('modules.create');
    }


    public function postStore()
    {

        $module = new Module();
        $module->module_name = Input::get('module_name');
        $module->module_url = Input::get('module_url');
        $module->parent_id = Input::get('parent_id');
        $module->is_inmenu = Input::get('is_inmenu');
        $module->is_active = Input::get('is_active');
        $module->module_controller = Input::get('module_controller');
        $save_module = $module->save();
        if ($save_module) {
            return json_encode([
                'code' => 200,
                'msg' => 'Stored the record',
                'result' => json_encode(Module::lists('module_name', 'module_id'))
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => 'Something went wrong. Please retry inserting proper data',
                'result' => null
            ]);
        }
    }


    public function show($id)
    {
        //
    }


    public function getEdit()
    {
        return View::make('modules.edit');
    }

    public function postFind($id)
    {

        $id = Helper::simple_decrypt($id); 
        $data = Module::find($id);
        $data->module_id = Helper::simple_encrypt($data->module_id);
        return Response::json($data);

    }


    public function postUpdate($id)
    {
        $id = Helper::simple_decrypt($id);
        $module = Module::find($id);
        $module->module_name = Input::get('module_name');
        $module->module_url = Input::get('module_url');
        $module->parent_id = Input::get('parent_id');
        $module->is_inmenu = Input::get('is_inmenu');
        $module->is_active = Input::get('is_active');
        $module->module_controller = Input::get('module_controller');

        $save_module = $module->save();
        if ($save_module) {
            return json_encode([
                'code' => 200,
                'msg' => 'Stored the record',
                'result' => json_encode(Module::lists('module_name', 'module_id'))
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => 'Something went wrong. Please retry inserting proper data',
                'result' => null
            ]);
        }
    }


    public function getDestroy($id)
    {
        $id = Helper::simple_decrypt($id);
        $save_module =  Module::destroy($id);
        if ($save_module) {
            return Response::json([
                'code' => 200,
                'msg' => 'Stored the record',
                'result' => null
            ]);
        } else {
            return Response::json([
                'code' => 403,
                'msg' => 'Something went wrong. Please retry inserting proper data',
                'result' => null
            ]);
        }
    }

}