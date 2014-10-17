<?php

$app->get('/check_name.json', function()use ($app) {
    $site = $app->request()->get('site');
    $app->log->addDebug('Request for check name received', array($app->request()));
    if ($site) {
        $model = new FastApi\Models\FastModel();
        $result = $model->checkName($site);
        $app->render(200, array('result' => $result));
    } else {
        $app->render(400,array(
            'message' => 'Invalid site!'
        ));
        $app->log->addError('Invalid site passed', array($app->request()));

    }
});
