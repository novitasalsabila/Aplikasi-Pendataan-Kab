<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationVersion extends Model
{
    use HasFactory;

    protected $fillable = ['application_id', 'version_code', 'release_date', 'changelog'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
