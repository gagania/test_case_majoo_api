<?php
namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model {
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bill_total'];
    
    function getMerchantOmzet($userId,$merchantId,$dateFrom,$dateTo) {
        $this->db->query("TRUNCATE TABLE calendar");
        $this->db->query("call report_merchant('".$dateFrom."','".$dateTo."')");
        $builder = $this->db->table('calendar');
        $builder->select("calendar.datefield AS date, (select IFNULL(SUM(x.bill_total),0) 
        from transactions x where x.merchant_id='".$merchantId."' 
        and DATE(x.created_at) = calendar.datefield) as omzet,
        (select merchant_name from merchants m where m.id='".$merchantId."' and m.user_id='".$userId."') as merchant_name");
        //$builder->join('merchants', 'merchants.id = transactions.merchant_id','LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }

    function getOutletOmzet($userId,$merchantId,$dateFrom,$dateTo,$outletId) {
        $this->db->query("TRUNCATE TABLE calendar_outlet");
        $this->db->query("call report_outlet('".$dateFrom."','".$dateTo."')");
        $builder = $this->db->table('calendar_outlet');
        $builder->select("calendar_outlet.datefield AS date, (select IFNULL(SUM(x.bill_total),0) 
        from transactions x where x.merchant_id='".$merchantId."' 
        and DATE(x.created_at) = calendar_outlet.datefield) as omzet,
        (select merchant_name from merchants m where m.id='".$merchantId."' and m.user_id='".$userId."') as merchant_name,
        (select outlet_name from outlets o where o.id='".$outletId."' and o.merchant_id='".$merchantId."') as outlet_name");
        //$builder->join('merchants', 'merchants.id = transactions.merchant_id','LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }

    function getData() {
        $sql = "select * from $this->table";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}

