<?php

namespace VCComponent\Laravel\SEO\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface HasSeoContract
{
    public function seoMetas();
    public function getAllSeoMeta(): Collection;
    public function getSeoMetas(array $keys): Collection;
    public function getSeoMeta($key): string;
    public function saveSeoMeta($key, $value);
    public function deleteSeoMeta($key);
}
