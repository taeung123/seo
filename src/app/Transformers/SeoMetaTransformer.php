<?php

namespace VCComponent\Laravel\SEO\Transformers;

use League\Fractal\TransformerAbstract;

class SeoMetaTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform($model)
    {
        return [
            'id'          => (int) $model->id,
            'object_id'   => (int) $model->object_id,
            'object_type' => $model->object_type,
            'key'         => $model->key,
            'value'       => $model->value,
            'timestamps'  => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ],
        ];
    }
}
