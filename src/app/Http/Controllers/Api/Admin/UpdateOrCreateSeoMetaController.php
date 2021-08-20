<?php

namespace VCComponent\Laravel\SEO\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use VCComponent\Laravel\SEO\Entities\SeoMeta;
use VCComponent\Laravel\SEO\Repositories\SeoMetaRepository;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;

class UpdateOrCreateSeoMetaController extends ApiController
{
    protected $credentials = [
        'object_id',
        'object_type',
    ];

    protected $repository;

    public function __construct(SeoMetaRepository $repository)
    {
        $this->repository = $repository;
        if (config('seo.auth_middleware.admin.middleware') !== '') {
            $this->middleware(
                config('seo.auth_middleware.admin.middleware'),
                ['except' => config('seo.auth_middleware.admin.except')]
            );
        }
        else{
            throw new Exception("Admin middleware configuration is required");
        }
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'object_id'   => ['required'],
            'object_type' => ['required'],
        ]);

        $credentials = $request->only($this->credentials);
        $data        = collect($request->all())->except($this->credentials)->map(function ($value, $key) {
            return [
                'key'   => $key,
                'value' => $value,
            ];
        })->toArray();

        $this->repository->bulkUpdateOrCreate($credentials, $data);

        return $this->success();
    }
}
