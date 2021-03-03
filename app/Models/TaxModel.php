<?php

namespace App\Models;
use CodeIgniter\Model;

/* change names when in production
tariffe, anno,  */

class TaxModel extends Model
{
    protected $table = 'taxes';
    protected $primaryKey = 'year';
    protected $returnType = 'array';
    protected $allowedFields = ['year', 'taxCitizen', 'taxBusiness'];

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


    //GET ALL or ONE record depending on parameter
    public function getTax($year = false) {
        if ($year === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['year' => $year]);
        }
    }

    public function store($year, $taxCitizen, $taxBusiness) {
      /* $data = array(
        'year' => $this->input->post('username'),
        'taxCitizen' => $this->input->post('password'),
        'taxBusiness' => $this->input->post('email')
      ); */
      $data = array(
        'year' => $year,
        'taxCitizen' => $taxCitizen,
        'taxBusiness' => $taxBusiness
      );

    // users is the name of the db table you are inserting in
    return $this->insert($data);
    }


}
