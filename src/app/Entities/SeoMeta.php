<?php

namespace VCComponent\Laravel\SEO\Entities;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $fillable = [
        'object_id',
        'object_type',
        'key',
        'value',
    ];

    public function scopeOfKey($query, $key)
    {
        return $query->where('key', $key);
    }

    public function scopeOfKeyIn($query, array $keys)
    {
        return $query->whereIn('key', $keys);
    }
}
