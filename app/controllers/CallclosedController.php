<?php

class CallclosedController extends \BaseController
{

    public function getIndexView()
    {
        return View::make('call_closed.index');
    }

    public function getIndexdataView()
    {
        $data1 = MarketingData::where('leads_statuses_id','=',9)->get();

        $returndata = [];
        foreach ($data1 as $k => $v) {

            $returndata[$k]['message'] = $v->message;
            $returndata[$k]['owner_name'] = $v->owner_name;
            $returndata[$k]['company_name'] = $v->company_name;
            $returndata[$k]['website'] = $v->website;
            $returndata[$k]['phone'] = $v->phone;
            $returndata[$k]['email'] = $v->email;

        }
        $data['call_closed'] = $returndata;

       return $data;
    }

    public function getNoteEdit()
    {
        return View::make('followup.note_edit');
    }
    public function postNoteDataEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data['marketing_data'] = MarketingData::find($id);
        $data['marketing_data']['leads_statuses_name'] = $data['marketing_data']->lead_status()->get()->first()->leads_statuses_name;
        $data['notes'] = $data['marketing_data']->notes()->orderBy('marketing_datas_notes_id','desc')->get();
        return $data;
    }

    public function postAddNoteEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data_note = new MarketingDatasNote();
        $data_note->marketing_datas_id = $id;
        $data_note->message = Input::get('message');
        $data_note->note_date = date('Y-m-d',strtotime(Input::get('note_date')));
        $data_note->note_time = date('H:i:s',strtotime(Input::get('note_time')));

        $save = $data_note->save();
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.update_record_msg'),
                'result' => MarketingData::find($id)->notes()->orderBy('marketing_datas_notes_id','desc')->get()
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