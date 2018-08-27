<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class Conteo extends Model
{
    protected $table = 'conteos';

    protected $fillable = ['tabla', 'valor'];
}
