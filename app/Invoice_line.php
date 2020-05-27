<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_line extends Model
{
    

    public function tool(){
        return $this->belongsTo(Tool::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
