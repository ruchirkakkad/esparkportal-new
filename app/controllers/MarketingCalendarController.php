<?php

class MarketingCalendarController extends \BaseController
{

    public function getIndexView()
    {
        return View::make('marketing_calendar.index');
    }

    public function getCalenderdataView()
    {
        $todaydate = date('Y-m-d', time());
        $weekafterdate = date('Y-m-d', strtotime("+10 days"));

        $query = " ";
        if(Auth::user()->role_id != Config::get('constants.marketing_admin_id'))
        {
            $query = "And md.user_id = ".Auth::user()->user_id;
        }

        $query = "SELECT * FROM marketing_datas_notes mdn
                LEFT JOIN marketing_datas md ON mdn.marketing_datas_id = md.marketing_datas_id
                WHERE marketing_datas_notes_id = (SELECT MAX(marketing_datas_notes_id) FROM marketing_datas_notes WHERE marketing_datas_id = mdn.marketing_datas_id)
                AND md.leads_statuses_id IN (2,5,6,8)
                $query
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
            $returndata[$k]['marketing_states_name'] = MarketingState::find($v->marketing_states_id)->pluck('marketing_states_name');
            $returndata[$k]['leads_statuses_id'] = $v->leads_statuses_id;
            $returndata[$k]['leads_statuses_name'] = LeadsStatus::find($v->leads_statuses_id)->pluck('leads_statuses_name');
        }
        $data['followup'] = $returndata;

        $data['lead_status'] = count($data1);
        return $data;
    }


}