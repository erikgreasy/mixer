<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Mix extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public static function booted()
    {
        static::creating(function (Mix $mix) {
            $mix->user_id = auth()->id();
        });
    }

    public function isPublished(): bool
    {
        return $this->published_at <= now();
    }

    public function url(): string
    {
        return route('mixes.show', $this);
    }

    public function upload(): Media
    {
        return $this->getFirstMedia('upload');
    }

    public function cover(): ?Media
    {
        return $this->getFirstMedia('cover');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereDate('published_at', '<=', now());
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('upload')->singleFile();
        $this->addMediaCollection('cover')->singleFile();
    }
}
