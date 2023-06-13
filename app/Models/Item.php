<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Item extends Model
{
    use HasFactory;
    protected $table = 'item';
    protected $primaryKey = 'item_id';
    
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orderline', 'item_id', 'orderinfo_id');
    }

    public function stock() 
    {
        return $this->hasOne(Stock::class, 'item_id');
    }
}
