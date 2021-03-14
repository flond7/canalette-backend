<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id_user';
  protected $returnType = 'array';
  protected $allowedFields = ['id_user', 'first_name', 'last_name', 'cf', 'email', 'tel', 'category'];

  public function joined($filter) {
    $data = $this->db->table('relational')
                     ->select('*')
                     ->join('users', 'users.id_user = relational.id_user', 'right outer')
                     ->join('taxes', 'taxes.id_year = relational.id_year', 'right outer')
                     ->join('drainChannels', 'drainChannels.id_drain = relational.id_drain', 'right outer')
                     ->where('cf', $filter)
                     ->get()->getResult();
    return $data;
  }
}

  /* NOTHING ELSE MATTERS */
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