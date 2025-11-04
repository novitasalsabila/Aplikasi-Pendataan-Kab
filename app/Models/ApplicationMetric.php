<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'check_date', 'uptime',
        'response_time', 'status', 'note'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
