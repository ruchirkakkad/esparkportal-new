<?php

class CompanyDetailsController extends \BaseController {

	public function getIndexView()
	{
		return View::make('company_details.index');
	}

    public function getIndexdataView()
	{
        $data['company_details'] = CompanyDetail::find(1);
		return $data;
	}

    public function postUpdateView()
    {
        $data = CompanyDetail::findOrNew(1);
        $data->company_name = Input::get('company_name');
        $data->company_url = Input::get('company_url');
        $data->company_address = Input::get('company_address');
        $data->company_phone = Input::get('company_phone');
        $data->cp_first_name = Input::get('cp_first_name');
        $data->cp_last_name = Input::get('cp_last_name');
        $data->cp_email = Input::get('cp_email');
        $data->cp_phone = Input::get('cp_phone');
        echo $data->save();
    }
}