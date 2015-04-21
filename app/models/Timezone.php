<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Timezone extends \Eloquent {

    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "timezones";

    protected $primaryKey = "timezones_id";

    public function marketing_states()
    {
        return $this->hasMany('MarketingState','marketing_states_id');
    }

}