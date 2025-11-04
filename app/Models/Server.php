<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = ['hostname', 'ip_address', 'os', 'location', 'managed_by', 'status'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
