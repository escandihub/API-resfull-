<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class region extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_reg';
    
    protected $fillable     = [ 'description', 'status' ];
}
