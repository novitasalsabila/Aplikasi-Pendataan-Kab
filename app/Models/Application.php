<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'category', 
        'data_sensitivity',
        'department_id', 
        'developer_id', 
        'server_id', 
        'status',
        'version_code',
        'release_date',
        'changelog',
        'last_update',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function server()
    {
        return $this->belongsTo(Server::class, 'server_id');
    }

    public function logs()
    {
        return $this->hasMany(ApplicationLog::class);
    }

    public function findings()
    {
        return $this->hasMany(ApplicationFinding::class);
    }

    public function audits()
    {
        return $this->hasMany(ApplicationSecurityAudit::class);
    }

    public function integrations()
    {
        return $this->hasMany(ApplicationIntegration::class, 'source_app_id');
    }

    public function backups()
    {
        return $this->hasMany(ApplicationBackup::class);
    }

    public function metrics()
    {
        return $this->hasMany(ApplicationMetric::class);
    }

    public function documents()
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    public function versions()
    {
        return $this->hasMany(ApplicationVersion::class);
    }
}
