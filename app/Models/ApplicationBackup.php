<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationBackup extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'backup_date', 'backup_type',
        'storage_location', 'verified_st'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
