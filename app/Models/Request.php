<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'app', 'requested_by'];

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
