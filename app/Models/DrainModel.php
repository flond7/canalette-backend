<?php

namespace App\Models;
use CodeIgniter\Model;

class DrainModel extends Model
{
  protected $table = 'drainChannels';
  protected $primaryKey = 'id_drain';
  protected $returnType = 'array';
  protected $allowedFields = ['id_drain', 'num', 'street', 'fogl', 'map'];

  public function joined($filter) {
    $data = $this->db->table('relational')
                     ->select('*')
                     ->join('users', 'users.id_user = relational.id_user', 'right outer')
                     ->join('taxes', 'taxes.id_year = relational.id_year', 'right outer')
                     ->join('drainChannels', 'drainChannels.id_drain = relational.id_drain', 'right outer')
                     ->where('num', $filter)
                     ->get()->getResult();
    return $data;
  }
}