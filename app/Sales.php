<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $primaryKey = "id";
    public $incrementing = true;

    protected $fillable = [
        'sale', 'quantity', 'item_id'
    ];
}
