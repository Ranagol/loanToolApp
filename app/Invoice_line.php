<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_line extends Model
{
    protected $guarded = ['id'];

    public function tool(){
        return $this->belongsTo(Tool::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
