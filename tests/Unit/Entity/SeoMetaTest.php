<?php

namespace VCComponent\Laravel\SEO\Test\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use VCComponent\Laravel\SEO\Entities\SeoMeta;
use VCComponent\Laravel\SEO\Test\Stubs\Entities\Test;
use VCComponent\Laravel\SEO\Test\TestCase;

class SeoMetaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_create_new_seo_meta()
    {
        $model = factory(Test::class)->create();

        $model->saveSeoMeta('title', 'abc');

        $this->assertDatabaseHas('seo_metas', [
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'key'         => 'title',
            'value'       => 'abc',
        ]);
    }

    /**
     * @test
     */
    public function can_update_old_seo_meta()
    {
        $model = factory(Test::class)->create();

        $model->saveSeoMeta('title', 'abc');
        $model->saveSeoMeta('title', 'xyz');

        $this->assertCount(1, SeoMeta::all()->toArray());
        $this->assertDatabaseHas('seo_metas', [
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'key'         => 'title',
            'value'       => 'xyz',
        ]);
    }

    /**
     * @test
     */
    public function can_delete_seo_meta()
    {
        $model = factory(Test::class)->create();

        $model->saveSeoMeta('title', 'abc');
        $model->deleteSeoMeta('title');

        $this->assertCount(0, SeoMeta::all()->toArray());
        $this->assertDatabaseMissing('seo_metas', [
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'key'         => 'title',
            'value'       => 'abc',
        ]);
    }

    /**
     * @test
     */
    public function can_get_single_seo_meta()
    {
        $model = factory(Test::class)->create();

        $model->saveSeoMeta('title', 'abc');
        $model->saveSeoMeta('description', 'description');
        $model->saveSeoMeta('image', 'imageUrl');

        $value = $model->getSeoMeta('title');

        $this->assertCount(3, SeoMeta::all()->toArray());
        $this->assertTrue(is_string($value));
        $this->assertSame($value, 'abc');
    }

    /**
     * @test
     */
    public function can_get_all_seo_metas()
    {
        $model = factory(Test::class)->create();

        $model->saveSeoMeta('title', 'abc');
        $model->saveSeoMeta('description', 'description');
        $model->saveSeoMeta('image', 'imageUrl');

        $value = $model->getAllSeoMeta('title');

        $this->assertInstanceOf(Collection::class, $value);
        $this->assertCount(3, $value->toArray());
    }

    /**
     * @test
     */
    public function can_get_list_of_specific_seo_metas()
    {
        $model = factory(Test::class)->create();

        $model->saveSeoMeta('title', 'abc');
        $model->saveSeoMeta('description', 'description');
        $model->saveSeoMeta('image', 'imageUrl');

        $value = $model->getSeoMetas();

        $this->assertInstanceOf(Collection::class, $value);
        $this->assertCount(3, $value->toArray());

        $value = $model->getSeoMetas(['title', 'image']);
        $keys  = $value->map(function ($item) {
            return $item->key;
        })->toArray();

        $this->assertInstanceOf(Collection::class, $value);
        $this->assertCount(2, $value->toArray());
        $this->assertSame($keys, [
            'title',
            'image',
        ]);
    }
}
