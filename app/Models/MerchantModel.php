<?php
namespace App\Models;

use CodeIgniter\Model;

class MerchantModel extends Model {
    protected $table = 'merchants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','merchant_name'];
    
    function getData($where = array()) {
        $builder = $this->db->table("$this->table as a");
        $builder->select("id,merchant_name");
        $builder->where($where);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    function check($userName) {
        $sql = "select id,user_name,user_pass,user_email,user_telp from $this->table where user_email='$userName' and is_verified='Y'";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
    
    function checkRegister($userName) {
        $sql = "select id,user_name,user_pass,user_email,user_telp from $this->table where user_email='$userName'";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
    function checkToken($userToken) {
        $sql = "select id,user_token from $this->table where user_token='$userToken'";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}

