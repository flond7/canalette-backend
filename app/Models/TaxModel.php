<?php

namespace App\Models;
use CodeIgniter\Model;

class TaxModel extends Model
{
  protected $table = 'taxes';
  protected $primaryKey = 'id_year';
  protected $returnType = 'array';
  protected $allowedFields = ['id_year', 'taxCitizen', 'taxBusiness', 'ivaFull', 'ivaSplit', 'IvaZero', 'mailing_money'];

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
