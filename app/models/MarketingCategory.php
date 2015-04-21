<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MarketingCategory extends \Eloquent {

    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "marketing_categories";

    protected $primaryKey = "marketing_categories_id";


    public function sheets()
    {
        return $this->hasMany('Sheet','marketing_categories_id');
    }
}