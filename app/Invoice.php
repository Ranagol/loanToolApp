<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function invoice_lines(){
        return $this->hasMany(Invoice_line::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
