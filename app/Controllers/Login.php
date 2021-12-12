<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;
 
class Login extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        helper(['form']);
        $rules = [
            'user_name' => 'required',
            'password' => 'required|min_length[6]'
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new UserModel();
        $user = $model->where("user_name", $this->request->getVar('user_name'))->first();
        if(!$user) return $this->failNotFound('User Name Not Found');
 
        $verify = password_verify($this->request->getVar('password'), $user['password']);
        if(!$verify) return $this->fail('Wrong Password');
 
        $key = getenv('TOKEN_SECRET');
        $payload = array(
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "uid" => $user['id'],
            "user_name" => $user['user_name']
        );
 
        $token = JWT::encode($payload, $key);
        if (!$token) {
            return $this->respond(array("error"=>'Token not created.'));
        }

        $result = array("user_id"=>$user['id'],"user_name"=>$user['user_name'],"token"=>$token);
        return $this->respond($result);
    }
}