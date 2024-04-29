<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commune extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_com';

    protected $fillable     = [ 'id_reg', 'description', 'status' ];

    public function region() {
        return $this->belongsTo(region::class, 'id_reg' );
    }
}
