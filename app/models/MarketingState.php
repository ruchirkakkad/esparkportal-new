<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MarketingState extends \Eloquent {

    use SoftDeletingTrait;
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

    protected $table = "marketing_states";

    protected $primaryKey = "marketing_states_id";

    public function country()
    {
        return $this->belongsTo('MarketingCountry', 'marketing_countries_id', 'marketing_countries_id');
    }

    public function timezone()
    {
        return $this->belongsTo('Timezone', 'timezones_id', 'timezones_id');
    }

    public function marketing_datas()
    {
        return $this->hasMany('MarketingData', 'marketing_datas_id','marketing_datas_id');
    }

}