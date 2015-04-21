<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Sheet extends \Eloquent {

    use SoftDeletingTrait;

    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = [];

    protected $table = "sheets";

    protected $primaryKey = "sheets_id";

    public function country()
    {
        return $this->belongsTo('MarketingCountry', 'marketing_countries_id', 'marketing_countries_id');
    }

    public function category()
    {
        return $this->belongsTo('MarketingCategory', 'marketing_categories_id', 'marketing_categories_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'user_id');
    }
}