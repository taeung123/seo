<?php

namespace VCComponent\Laravel\SEO\Test\Stubs\Entities;

use Illuminate\Database\Eloquent\Model;
use VCComponent\Laravel\SEO\Contracts\HasSeoContract;
use VCComponent\Laravel\SEO\Traits\HasSeoTrait;

class Test extends Model implements HasSeoContract
{
    use HasSeoTrait;

    protected $fillable = [
        'name',
        'description',
    ];
}
