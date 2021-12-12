<?php
namespace App\Models;

use CodeIgniter\Model;

class OutletsModel extends Model {
    protected $table = 'outlets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['outlet_name'];
    
    function getAll($where = array()) {
        $builder = $this->db->table("$this->table as a");
        $builder->select("a.id,a.outlet_name,a.created_at,b.merchant_name");
        $builder->join("merchants b","b.id=a.merchant_id");
        $builder->where($where);
        $query = $builder->get();
        return $query->getResultArray();
    }

    function getData($merchantId) {
        $sql = "select id,outlet_name from $this->table where merchant_id=$merchantId";
        $query = $this->db->query($sql);
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

