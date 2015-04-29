<?php

class MarketingReportController extends \BaseController
{

    public function getIndexOneView()
    {
        return View::make('marketing_report.index_one');
    }

    public function getIndexOneDataView()
    {
        $data1 = User::where('designation_id', '=', 6)->get();

        $returndata = [];
        foreach ($data1 as $k => $v) {

            $id = Helper::simple_encrypt($v->user_id);
            $returndata[$k]['user_id'] = $v->user_id;
            $returndata[$k]['user_encryt_id'] = $id;
            $returndata[$k]['first_name'] = $v->first_name;
            $returndata[$k]['last_name'] = $v->last_name;
        }
        $data['marketing_users'] = $returndata;

        return $data;
    }

    public function getIndexTwoView()
    {
        return View::make('marketing_report.index_two');
    }

    public function getIndexTwoDataView($id)
    {
        $id = Helper::simple_decrypt($id);

        $query = "SELECT `data` , CONCAT(leads_statuses_name,'-',`data`) AS label FROM
                    (
                    SELECT leads_statuses_name,
                    (SELECT COUNT(*) FROM marketing_datas
                    WHERE leads_statuses.leads_statuses_id = marketing_datas.leads_statuses_id AND marketing_datas.user_id = $id )
                    `data` FROM leads_statuses
                    ) tab2";

        $data['total'] = DB::select(DB::raw($query));
        return $data;
    }

}