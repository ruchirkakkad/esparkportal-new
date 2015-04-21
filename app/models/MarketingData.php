<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MarketingData extends \Eloquent {

    use SoftDeletingTrait;

    public static $rules = [
        'owner_name' => '',
        'company_name' => '',
        'website' => 'required|unique:marketing_datas',
        'phone' => '',
        'email' => 'sometimes|email',
        'marketing_states_id' => 'required',
        'marketing_categories_id' => 'required',
        'user_id' => '',
        'leads_statuses_id' => ''
    ];

    protected $fillable = [];

    protected $table = "marketing_datas";

    protected $primaryKey = "marketing_datas_id";

    public function marketing_states()
    {
        return $this->belongsTo('MarketingState');
    }

    public function lead_status()
    {
        return $this->belongsTo('LeadsStatus');
    }
}