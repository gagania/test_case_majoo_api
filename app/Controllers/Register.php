<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
 
class Register extends ResourceController
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
            'name' => 'required|is_unique[users.name]',
            'user_name' => 'required|is_unique[users.user_name]',
            'password' => 'required|min_length[6]',
            'confpassword' => 'matches[password]'
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $data = [
            'name'     => $this->request->getVar('name'),
            'user_name'     => $this->request->getVar('user_name'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT) 
        ];
        $model = new UserModel();
        $registered = $model->save($data);
        return $this->respondCreated($registered);
 
    }
 
}