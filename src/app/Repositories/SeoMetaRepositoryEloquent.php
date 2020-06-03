<?php

namespace VCComponent\Laravel\SEO\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\SEO\Entities\SeoMeta;
use VCComponent\Laravel\SEO\Repositories\SeoMetaRepository;

/**
 * Class AccountantRepositoryEloquent.
 */
class SeoMetaRepositoryEloquent extends BaseRepository implements SeoMetaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SeoMeta::class;
    }

    public function getEntity()
    {
        return $this->model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function bulkUpdateOrCreate($credentials, $data)
    {
        foreach ($data as $value) {
            $this->model->updateOrCreate(
                array_merge($credentials, ['key' => $value['key']]),
                [
                    'value' => $value['value'],
                ]
            );
        }
    }
}
