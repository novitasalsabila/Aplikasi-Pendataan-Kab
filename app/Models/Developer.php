<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'developer_type', 'contract_number',
        'contract_date', 'contact_email', 'contact_phone'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class,'developer_id');
    }
}
