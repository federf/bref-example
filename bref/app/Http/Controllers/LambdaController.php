<?php

namespace App\Http\Controllers;

class LambdaController extends Controller
{
    public function __construct()
    {
    }

    public function hello($name = '')
    {
        $lambda = new \Aws\Lambda\LambdaClient([
            'version' => 'latest',
            'region'  => 'us-east-1',
        ]);

        $params = [];
        if (!empty($name)) {
            $params = ['name' => $name];
        }

        $result = $lambda->invoke([
            'FunctionName'   => 'app-dev-hello',
            'InvocationType' => 'RequestResponse',
            'LogType'        => 'None',
            'Payload'        => json_encode($params),
        ]);

        $result = json_decode($result->get('Payload')->getContents(), true);
        var_dump($result);
    }

}
