<?php

namespace App\Models;

use App\Services\Aws\S3FileManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pages';

    protected $fillable = ['title', 'description', 'original_url', 'published_at', 'image_key'];

    public function getImageAttribute(): string | null
    {
        if (! $this->getAttribute('image_key')) {
            return null;
        }
        return (new S3FileManager())->get($this->image_key);
    }
}
