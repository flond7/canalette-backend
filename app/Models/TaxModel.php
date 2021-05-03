<?php

namespace App\Models;
use CodeIgniter\Model;

class TaxModel extends Model
{
  protected $table = 'taxes';
  protected $primaryKey = 'id_year';
  protected $returnType = 'array';
  protected $allowedFields = ['id_year', 'taxCitizen', 'taxBusiness', 'ivaFull', 'ivaSplit', 'IvaZero', 'mailing_money'];

  public function joined($filter) {
    $data = $this->db->table('relational')
                     ->select('*')
                     ->join('users', 'users.id_user = relational.id_user', 'right outer')
                     //->join('taxes', 'taxes.id_year = relational.id_year', 'right outer')
                     ->join('drainChannels', 'drainChannels.id_drain = relational.id_drain', 'right outer')
                     ->where('id_year', $filter)
                     ->get()->getResult();
    return $data;
  }

  /* NOTHING ELSE HERE */

  /*
    protected $table = '';
    protected $primaryKey = '';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    */


}
