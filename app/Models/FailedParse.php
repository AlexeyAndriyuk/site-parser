<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedParse extends Model
{
    use HasFactory;

    protected $table = 'failed_parses';

    protected $fillable = ['link', 'error'];
}
