<?php

class FollowupController extends \BaseController
{

    public function getIndexView()
    {
        return View::make('followup.index');
    }

    public function getIndexdataView()
    {
        $todaydate = date('Y-m-d', time());
        $weekafterdate = date('Y-m-d', strtotime("+10 days"));
//        dd($weekafterdate);
        $query = "SELECT * FROM marketing_datas_notes mdn
                LEFT JOIN marketing_datas md ON mdn.marketing_datas_id = md.marketing_datas_id
                WHERE marketing_datas_notes_id = (SELECT MAX(marketing_datas_notes_id) FROM marketing_datas_notes WHERE marketing_datas_id = mdn.marketing_datas_id)
                AND md.leads_statuses_id IN (2,5,6,8)
                AND note_date BETWEEN '$todaydate' AND '$weekafterdate'
                GROUP BY mdn.marketing_datas_id
                ORDER BY mdn.note_date";
        $data1 = DB::select(DB::raw($query));

        $returndata = [];
        foreach ($data1 as $k => $v) {
            $id = Helper::simple_encrypt($v->marketing_datas_id);
            $returndata[$k]['marketing_datas_id'] = $v->marketing_datas_id;
            $returndata[$k]['marketing_datas_encryt_id'] = $id;
            $returndata[$k]['note_date'] = $v->note_date;
            $returndata[$k]['note_time'] = $v->note_time;
            $returndata[$k]['message'] = $v->message;
            $returndata[$k]['owner_name'] = $v->owner_name;
            $returndata[$k]['website'] = $v->website;
            $returndata[$k]['phone'] = $v->phone;
            $returndata[$k]['leads_statuses_id'] = $v->leads_statuses_id;
            $returndata[$k]['leads_statuses_name'] = LeadsStatus::find($v->leads_statuses_id)->pluck('leads_statuses_name');
        }

        $data['followup'] = $returndata;

        $data['lead_status'] = LeadsStatus::select('leads_statuses_name', 'leads_statuses_id')->get();
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