<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MarketingDatasNote extends \Eloquent {
    use SoftDeletingTrait;

    public static $rules = [

    ];

    protected $fillable = [];

    protected $table = "marketing_datas_notes";

    protected $primaryKey = "marketing_datas_notes_id";

    public function marketing_datas()
    {
        return $this->hasMany('MarketingData','marketing_datas_id','marketing_datas_id');
    }

}