<?php

use VCComponent\Laravel\SEO\Http\Controllers\Api\Admin\UpdateOrCreateSeoMetaController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'admin'], function ($api) {
        // Update or Create Seo Meta
        $api->post('seo-metas/update-or-create', UpdateOrCreateSeoMetaController::class);
    });
});
