<?php

namespace VCComponent\Laravel\Generator\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use VCComponent\Laravel\SEO\Entities\SeoMeta;
use VCComponent\Laravel\SEO\Test\Stubs\Entities\Test;
use VCComponent\Laravel\SEO\Test\TestCase;

class UpdateOrCreateSeoMetaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_create_seo_meta()
    {
        $model = factory(Test::class)->create();
        $data  = [
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'title'       => 'seo title',
            'description' => 'seo description',
        ];

        $response = $this->json('POST', 'api/admin/seo-metas/update-or-create', $data);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
        ]);
        $this->assertDatabaseHas('seo_metas', [
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'key'         => 'title',
            'value'       => 'seo title',
        ]);
        $this->assertDatabaseHas('seo_metas', [
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'key'         => 'description',
            'value'       => 'seo description',
        ]);
        $this->assertSame('seo title', $model->getSeoMeta('title'));
        $this->assertSame('seo description', $model->getSeoMeta('description'));
    }

    /**
     * @test
     */
    public function can_update_old_seo_meta()
    {
        $model = factory(Test::class)->create();
        factory(SeoMeta::class)->create([
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'key'         => 'title',
            'value'       => 'seo title',
        ]);
        $data = [
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'title'       => 'seo title update',
            'description' => 'seo description',
        ];

        $response = $this->json('POST', 'api/admin/seo-metas/update-or-create', $data);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
        ]);
        $this->assertDatabaseHas('seo_metas', [
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'key'         => 'title',
            'value'       => 'seo title update',
        ]);
        $this->assertDatabaseHas('seo_metas', [
            'object_id'   => $model->id,
            'object_type' => 'tests',
            'key'         => 'description',
            'value'       => 'seo description',
        ]);
        $this->assertSame('seo title update', $model->getSeoMeta('title'));
        $this->assertSame('seo description', $model->getSeoMeta('description'));
    }

    /**
     * @test
     */
    public function object_id_field_must_be_required()
    {
        $data = [];

        $response = $this->json('POST', 'api/admin/seo-metas/update-or-create', $data);

        $this->assertValidation($response, 'object_id', 'The object id field is required.');
    }

    /**
     * @test
     */
    public function object_type_field_must_be_required()
    {
        $data = [
            'object_id' => 1,
        ];

        $response = $this->json('POST', 'api/admin/seo-metas/update-or-create', $data);

        $this->assertValidation($response, 'object_type', 'The object type field is required.');
    }
}
