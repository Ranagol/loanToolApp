<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $guarded = ['id'];
    
    public function invoice_lines(){
        return $this->hasMany(Invoice_line::class);
    }
}
