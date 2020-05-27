<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    public function invoice_lines(){
        return $this->hasMany(Invoice_line::class);
    }
}
