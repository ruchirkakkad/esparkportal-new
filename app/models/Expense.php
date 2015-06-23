<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Expense extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "expenses";

    protected $primaryKey = "expenses_id";

}