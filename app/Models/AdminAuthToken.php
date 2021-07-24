<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAuthToken extends Model
{
    use HasFactory;
    protected $table = 'admin_token';

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}
