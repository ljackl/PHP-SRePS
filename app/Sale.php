<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    public $incrementing = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale', 'quantity', 'item_id'
    ];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
