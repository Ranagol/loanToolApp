<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];
    
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}