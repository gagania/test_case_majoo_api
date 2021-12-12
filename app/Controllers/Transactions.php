<?php

namespace App\Controllers;

// use App\Models\MerchantModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Firebase\JWT\JWT;

class Transactions extends ResourceController
{
    protected $modelName = 'App\Models\TransactionModel';
    
    public function merchantOmzet() {
        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return $this->failUnauthorized('Token Required');
        $token = explode(' ', $header)[1];
        $where = array();
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
                
                if ($this->request->getVar('merchant_id')){
                    $merchantId = $this->request->getVar('merchant_id');
                }
                if ($this->request->getVar('date_from')){
                    $dateFrom = $this->request->getVar('date_from');
                }
                if ($this->request->getVar('date_to')){
                    $dateTo = $this->request->getVar('date_to');
                }
                if ($this->request->getVar('user_id')){
                    $userId = $this->request->getVar('user_id');
                }
                
                $omzetData = $this->model->getMerchantOmzet($userId,$merchantId,$dateFrom,$dateTo);
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Merchant Omzet Data',
                    'data' => [
                        'merchant' => $omzetData
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

    public function outletOmzet() {
        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return $this->failUnauthorized('Token Required');
        $token = explode(' ', $header)[1];
        $where = array();
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
                
                if ($this->request->getVar('merchant_id')){
                    $merchantId = $this->request->getVar('merchant_id');
                }
                if ($this->request->getVar('outlet_id')){
                    $outletId = $this->request->getVar('outlet_id');
                }
                if ($this->request->getVar('date_from')){
                    $dateFrom = $this->request->getVar('date_from');
                }
                if ($this->request->getVar('date_to')){
                    $dateTo = $this->request->getVar('date_to');
                }
                if ($this->request->getVar('user_id')){
                    $userId = $this->request->getVar('user_id');
                }
                
                $outletOmzetData = $this->model->getOutletOmzet($userId,$merchantId,
                            $dateFrom,$dateTo,$outletId);
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'Outlet Omzet Data',
                    'data' => [
                        'outlet' => $outletOmzetData
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

    public function index()
    {
        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return $this->failUnauthorized('Token Required');
        $token = explode(' ', $header)[1];

        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {
                $merchantData = $this->model->getMerchantOmzet();
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