<?php

class LeadsController extends \BaseController
{

    public function getIndexOneView()
    {
        return View::make('leads.index_one');
    }

    public function postLeadsListingView()
    {

        $data['leads'] = LeadsStatus::where('leads_statuses_id', '!=', '9')->get();

        foreach ($data['leads'] as $key => $val) {
            $data['leads'][$key]->leads_statuses_id = Helper::simple_encrypt($data['leads'][$key]->leads_statuses_id);
        }
        return json_encode($data);
    }

    public function getIndexTwoView()
    {
        return View::make('leads.index_two');
    }

    public function getLeadsWiseDataView($id)
    {
        $id = Helper::simple_decrypt($id);
        $data['lead_name'] = LeadsStatus::find($id)->leads_statuses_name;
        $data1 = MarketingData::leftJoin('leads_statuses', 'leads_statuses.leads_statuses_id', '=', 'marketing_datas.leads_statuses_id')
            ->where('leads_statuses.leads_statuses_id', '=', $id)
            ->orderBy('marketing_datas.marketing_datas_id', 'desc')
            ->get();

        $returndata = [];
        foreach ($data1 as $k => $v) {
            $id = Helper::simple_encrypt($v->marketing_datas_id);
            $returndata[$k]['marketing_datas_id'] = $v->marketing_datas_id;
            $returndata[$k]['marketing_datas_encryt_id'] = $id;
            $returndata[$k]['owner_name'] = $v->owner_name;
            $returndata[$k]['company_name'] = $v->company_name;
            $returndata[$k]['website'] = $v->website;
            $returndata[$k]['phone'] = $v->phone;
            $returndata[$k]['email'] = $v->email;
            $returndata[$k]['leads_statuses_id'] = "$v->leads_statuses_id";
            $returndata[$k]['leads_statuses_name'] = "$v->leads_statuses_name";
        }

        $data['aaData'] = $returndata;
        $data['lead_status'] = LeadsStatus::select('leads_statuses_name', 'leads_statuses_id')->get();


        return $data;
    }

    public function postChangeLeadStatusEdit()
    {
        $data = MarketingData::find(Input::get('id'));
        $data->leads_statuses_id = Input::get('leads_statuses_id');

        $save = $data->save();
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => 'status updated',
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