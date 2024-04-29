<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'dni';
    protected $keyType = 'string';
    protected $fillable = ['dni','id_reg','id_com','email','name','eliminado','last_name', 'address','date_reg'];

    
    public function commune()
    {
        return $this->belongsTo(commune::class, 'id_com', 'id_com');
    }
    public function region()
    {
        return $this->belongsTo(region::class, 'id_reg', 'id_reg');
    }
}

