<?php

class LayoutController extends \BaseController
{

    public function noPermission()
    {
        return View::make('nopermission');
    }

    public function masterView()
    {
        return View::make('layout.master');
    }

    public function appView()
    {
        return View::make('layout.app');
    }

    public function headerView()
    {
//        $data['header_menu'] = Module::all();
//        $newArray = [];
//        $this->display_children(0, 1,$newArray);die;
        return View::make('layout.header');
    }

    public function headerDataView()
    {

        $permission = Session::get('permission');

        $modules = array();

        $first_level = Module::where('parent_id', '=', 0)->get();
        foreach ($first_level as $key1 => $value1) {
            $count_level_1 = 0;
            foreach ($permission as $k_1 => $v_1) {
                if ($v_1['parent_id'] == $value1['module_id']) {
                    if ($v_1['view'] == 1) {
                        $count_level_1 = 1;
                    }
                }
            }
            if ($count_level_1 == 1) {
                $modules[$key1]['label'] = $value1['module_name'];
                $modules[$key1]['value'] = $value1['module_id'];
                $modules[$key1]['url'] = $value1['module_url'];
                $modules[$key1]['children'] = array();

                $second_level = Module::where('parent_id', '=', $value1['module_id'])->get();

                foreach ($second_level as $key2 => $value2) {


                    $third_level = Module::where('parent_id', '=', $value2['module_id'])->get();
                    $count_level_2 = 0;
                    foreach ($permission as $k => $v) {
                        if ($v['parent_id'] == $value2['module_id']) {
                            if ($v['view'] == 1) {
                                $count_level_2 = 1;
                            }
                        }
                    }

                    if (count($third_level) > 0) {
                        if ($count_level_2 == 1) {
                            $modules[$key1]['children'][$key2]['children'] = array();
                            $modules[$key1]['children'][$key2]['label'] = $value2['module_name'];
                            $modules[$key1]['children'][$key2]['value'] = $value2['module_id'];
                            $modules[$key1]['children'][$key2]['url'] = $value2['module_url'];
                            foreach ($third_level as $key3 => $value3) {
                                if(isset($permission[$value3["module_id"]]))
                                {
                                if ($permission[$value3["module_id"]]['view'] == 1) {

                                    $modules[$key1]['children'][$key2]['children'][$key3]['label'] = $value3['module_name'];
                                    $modules[$key1]['children'][$key2]['children'][$key3]['value'] = $value3['module_id'];
                                    $modules[$key1]['children'][$key2]['children'][$key3]['url'] = $value3['module_url'];

                                }
                                }
                            }
                        }
                    } else {
                         if(isset($permission[$value2["module_id"]]))
                                {
                        if ($permission[$value2["module_id"]]['view'] == 1) {
                            $modules[$key1]['children'][$key2]['label'] = $value2['module_name'];
                            $modules[$key1]['children'][$key2]['value'] = $value2['module_id'];
                            $modules[$key1]['children'][$key2]['url'] = $value2['module_url'];
                            $modules[$key1]['children'][$key2]['secondMenu'] = 1;
                        }
                                }
                    }
                }
            }

        }
        $data['modules'] = $modules;
        $data['notification_count'] = NotificationTo::where('users_id','=',Auth::user()->user_id)
                                    ->where('status','=','unread')->count();
        return json_decode(json_encode($data), true);
    }

    public function notificationCounter()
    {
        $data['notification_count'] = NotificationTo::where('users_id','=',Auth::user()->user_id)
            ->where('status','=','unread')->count();
        return json_decode(json_encode($data), true);
    }


    public function display_children($parent, $level, $newArray)
    {
        $result = DB::select(DB::raw("SELECT a.module_id, a.module_name, a.module_url, Deriv1.Count FROM `modules` a LEFT OUTER JOIN (SELECT parent_id, COUNT(*) AS Count FROM `modules` GROUP BY parent_id) Deriv1 ON a.module_id = Deriv1.parent_id WHERE a.parent_id=" . $parent));

        echo "<ul>";
        foreach ($result as $key => $row) {
            if ($row->Count > 0) {
                $newArray[] = '';
                echo "<li><a href='" . $row->module_url . "'>" . $row->module_name . "</a>";
                $this->display_children($row->module_id, $level + 1, $newArray);
                echo "</li>";
            } elseif ($row->Count == 0) {
                echo "<li><a href='" . $row->module_url . "'>" . $row->module_name . "</a></li>";
            } else;
        }
        echo "</ul>";
    }

    public function asideView()
    {
        return View::make('layout.aside');
    }

    public function navView()
    {
        return View::make('layout.nav');
    }


}