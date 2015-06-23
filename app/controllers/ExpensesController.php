<?php

class ExpensesController extends \BaseController {
    public function getIndexView()
    {
        return View::make('expenses.index');
    }

    public function getIndexdataView()
    {
        $data1 = Expense::get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['expenses_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('expenses.create');
    }

    public function postStoreAdd()
    {
        $expenses = new Expense();
        $expenses->date = date('Y-m-d',strtotime(Input::get('date')));
        $expenses->expense_type = Input::get('expense_type');
        $expenses->amount_type = Input::get('amount_type');
        $expenses->cheque_number = Input::get('cheque_number');
        $expenses->reason = Input::get('reason');
        $expenses->amount = Input::get('amount');
        $save = $expenses->save();
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
        return View::make('expenses.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data = Expense::find($id);
        $data->expenses_id = Helper::simple_encrypt($data->expenses_id);
        return Response::json($data);
    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $expenses = Expense::find($id);
        $expenses->date = date('Y-m-d',strtotime(Input::get('date')));
        $expenses->expense_type = Input::get('expense_type');
        $expenses->amount_type = Input::get('amount_type');
        $expenses->cheque_number = Input::get('cheque_number');
        $expenses->reason = Input::get('reason');
        $expenses->amount = Input::get('amount');

        $save = $expenses->save();
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
        $id = Helper::simple_decrypt($id);
        $expenses = Expense::find($id);

        $save = $expenses->delete();
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