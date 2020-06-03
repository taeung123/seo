<?php

namespace VCComponent\Laravel\SEO\Traits;

use Illuminate\Database\Eloquent\Collection;
use VCComponent\Laravel\SEO\Entities\SeoMeta;

trait HasSeoTrait
{
    public function seoMetas()
    {
        return $this->morphMany(SeoMeta::class, 'object');
    }

    public function getAllSeoMeta(): Collection
    {
        return $this->seoMetas;
    }

    public function getSeoMetas(array $keys = []): Collection
    {
        if (!count($keys)) {
            return $this->getAllSeoMeta();
        }
        return $this->seoMetas()->ofKeyIn($keys)->get();
    }

    public function getSeoMeta($key): string
    {
        $item = $this->seoMetas()->ofKey($key)->firstOrFail();
        return $item->value;
    }

    public function saveSeoMeta($key, $value)
    {
        $this->seoMetas()->updateOrCreate([
            'key' => $key,
        ], [
            'value' => $value,
        ]);
    }

    public function deleteSeoMeta($key)
    {
        $item = $this->seoMetas()->ofKey($key)->firstOrFail();
        $item->delete();
    }
}
