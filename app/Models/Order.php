<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function order_details()
    {
        return $this->hasMany(OrderDetails::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
