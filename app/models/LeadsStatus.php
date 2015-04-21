<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class LeadsStatus extends \Eloquent {

    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "leads_statuses";

    protected $primaryKey = "leads_statuses_id";


    public function marketing_datas()
    {
        return $this->hasMany('marketing_data','leads_statuses_id');
    }
}