<?php

namespace App\Models;
use CodeIgniter\Model;

class RelationalModel extends Model
{
  protected $table = 'relational';
  protected $primaryKey = 'id';
  protected $returnType = 'array';
  protected $allowedFields = ['id', 'amount_computed', 'amount_paid', 'paid', 'id_user', 'id_drain', 'id_year'];

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
