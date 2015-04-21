<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MarketingCountry extends \Eloquent {

    use SoftDeletingTrait;

	protected $fillable = [];

    protected $table = "marketing_countries";

    protected $primaryKey = "marketing_countries_id";

    public function sheets()
    {
        return $this->hasMany('Sheet','marketing_countries_id');
    }

    public function marketing_states()
    {
        return $this->hasMany('MarketingState','marketing_countries_id');
    }

}