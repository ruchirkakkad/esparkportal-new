<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MarketingData extends \Eloquent {

    use SoftDeletingTrait;

    public static $rules = [

        'website' => 'required|unique:marketing_datas',

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
        return $this->belongsTo('MarketingState','marketing_states_id','marketing_states_id');
    }

    public function marketing_categories()
    {
        return $this->belongsTo('MarketingCategory');
    }

    public function lead_status()
    {
        return $this->belongsTo('LeadsStatus','leads_statuses_id','leads_statuses_id');
    }

    public function notes()
    {
        return $this->hasMany('MarketingDatasNote','marketing_datas_id','marketing_datas_id');
    }
}