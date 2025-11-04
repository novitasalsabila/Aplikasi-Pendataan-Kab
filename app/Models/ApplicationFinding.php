<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationFinding extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'type', 'source', 'severity',
        'description', 'status', 'follow_up_action', 'follow_up_date'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
