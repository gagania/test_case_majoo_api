<?php

namespace App\Controllers;

// use App\Models\MerchantModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Firebase\JWT\JWT;

class Merchants extends ResourceController
{
    protected $modelName = 'App\Models\MerchantModel';
    public function index()
    {
        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return $this->failUnauthorized('Token Required');
        $token = explode(' ', $header)[1];

        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
                $userId = $this->request->getVar('user_id');
                if ($userId) {
                    $merchantData = $this->model->getData(array('user_id'=>$userId));
                }
                
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Merchant Data',
                    'data' => [
                        'merchant' => $merchantData
                    ]
                ];
                
                return $this->respondCreated($response);
            }
        } catch (Exception $ex) {
          
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }
    }
}