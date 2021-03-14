<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id_user';
  protected $returnType = 'array';
  protected $allowedFields = ['id_user', 'first_name', 'last_name', 'cf', 'email', 'tel', 'category'];

  public function joined($filter){
    $builder = $this->db->table("relational");
    $builder->select('*');
    //$builder->select('title, content, date');  //JUST SOME COLS
    $builder->join('users', 'users.id_user = relational.id_user', 'right outer');
    $builder->join('taxes', 'taxes.id_year = relational.id_year', 'right outer');
    $builder->join('drainChannels', 'drainChannels.id_drain = relational.id_drain', 'right outer');
    //$data = $builder->get()->getResult();
    $data = $builder->getWhere(['cf' => $filter])->getResult();
    return $data;
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

}
