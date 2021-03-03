<?php

namespace App\Models;

use CodeIgniter\Model;

/* change names when in production
tariffe, anno,  */

class TariffeModel extends Model
{
    protected $table = 'tariffe';
    protected $primaryKey = 'anno';

    protected $validationRules    = [
        'anno' => 'required|alpha_numeric_space|min_length[3]',
        'impostaPrivati' => 'required|valid_email|is_unique[users.email]',
        'impostaAziende' => 'required|min_length[8]'
    ];

    protected $validationMessages = [
        'anno'        => [
            'is_unique' => 'Questo anno risulta già inserito nel database.'
        ]
    ];

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
    public function getTax($year = false)
    {
        if ($year === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['anno' => $year]);
        }
    }


    //POST one record
    public function postTax($year, $taxCitizen, $taxBusiness) {
        $data = [
            'anno' => $year,
            'impostaPrivati' => $taxCitizen,
            'impostaAziende' => $taxBusiness
        ];
        $this->insert($data);
    }
}
