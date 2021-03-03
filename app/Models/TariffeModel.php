<?php

namespace App\Models;
use CodeIgniter\Model;

class TariffeModel extends Model
{
    protected $table = 'tariffe';
    
    public function getTariffe($year = false) {
        if ($year === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['anno' => $year]);
        }   
    }
}

