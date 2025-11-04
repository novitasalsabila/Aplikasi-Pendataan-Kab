<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationIntegration extends Model
{
    use HasFactory;

    protected $fillable = ['source_app_id', 'target_app_id', 'type', 'description'];

    public function sourceApp()
    {
        return $this->belongsTo(Application::class, 'source_app_id');
    }

    public function targetApp()
    {
        return $this->belongsTo(Application::class, 'target_app_id');
    }
}
