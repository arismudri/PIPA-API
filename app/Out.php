<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Out extends Model
{
    protected $fillable = ['item_id', 'jumlah', 'keterangan'];
    
}
