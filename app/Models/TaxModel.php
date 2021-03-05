<?php

namespace App\Models;
use CodeIgniter\Model;

class TaxModel extends Model
{
  protected $table = 'taxes';
  protected $primaryKey = 'year';
  protected $returnType = 'array';
  protected $allowedFields = ['year', 'taxCitizen', 'taxBusiness'];

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
