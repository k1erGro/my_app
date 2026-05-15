<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount',
        'description',
        'status',
        'order_id',
        'user_id'
    ];

    public function getAmount()
    {
        $this->amount;
    }

    public function getDescription(){
        $this->description;
    }

    public function getStatus(){
        $this->status();
    }

}
