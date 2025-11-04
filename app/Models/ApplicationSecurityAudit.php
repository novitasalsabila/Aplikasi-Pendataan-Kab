<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationSecurityAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'audit_date', 'auditor_name',
        'risk_level', 'summary', 'recommendation'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
