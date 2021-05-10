<?php

namespace App\Models;
use CodeIgniter\Model;

class RelationalModel extends Model
{
  protected $table = 'relational';
  protected $primaryKey = 'id';
  protected $returnType = 'array';
  protected $allowedFields = ['id', 'amount_computed', 'amount_paid', 'paid', 'id_user', 'id_drain', 'id_year', 'bill_number'];

  public function checkRecordExist($year, $user, $drain) {
    $data = $this->db->table('relational')
                     ->select('*')
                     ->join('users', 'users.id_user = relational.id_user', 'right outer')
                     ->join('taxes', 'taxes.id_year = relational.id_year', 'right outer')
                     ->join('drainChannels', 'drainChannels.id_drain = relational.id_drain', 'right outer')
                     ->where('relational.id_year', $year)
                     ->where('relational.id_user', $user)
                     ->where('relational.id_drain', $drain)
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
