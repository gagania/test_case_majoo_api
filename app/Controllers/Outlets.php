<?php

namespace App\Controllers;

// use App\Models\MerchantModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Firebase\JWT\JWT;

class Outlets extends ResourceController
{
    protected $modelName = 'App\Models\OutletsModel';
    
    public function index() {
        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return $this->failUnauthorized('Token Required');
        $token = explode(' ', $header)[1];

        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
            if ($decoded) {
                $outletData = $this->model->getAll();
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Outlets Data',
                    'data' => [
                        'outlets' => $outletData
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

    public function outlet_all() {
        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return $this->failUnauthorized('Token Required');
        $token = explode(' ', $header)[1];

        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
            if ($decoded) {
                $where = array();
                if ($this->request->getVar('merchant_id')){
                    $where['a.merchant_id'] = $this->request->getVar('merchant_id');
                }
                if ($this->request->getVar('outlet_id')){
                    $where['a.id'] = $this->request->getVar('outlet_id');
                }
                $outletData = $this->model->getAll($where);
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Outlets Data',
                    'data' => [
                        'outlets' => $outletData
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

    public function merchant_outlet() {
        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return $this->failUnauthorized('Token Required');
        $token = explode(' ', $header)[1];

        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
            if ($decoded) {
                $merchantId = $this->request->getVar('merchant_id');
                if ($merchantId) {
                    $outletData = $this->model->getData($merchantId);
                }
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Outlets Data',
                    'data' => [
                        'outlets' => $outletData
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