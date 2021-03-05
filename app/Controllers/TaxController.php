<?php

namespace App\Controllers;

use App\Models\TaxModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class TaxController extends Controller {

  use ResponseTrait;

  // show list
  // SERVER IP/canalette-backend/taxController/
  public function index() {
    $model = new TaxModel();
    $data['items'] = $model->orderBy('year', 'DESC')->findAll();
    return $this->respond($data);
  }

  // show single item
  // SERVER IP/canalette-backend/taxController/showItem/$id
  public function showItem($id = null) {
    $model = new TaxModel();
    $data = $model->getWhere(['year' => $id])->getResult();
    if ($data) {
      return $this->respond($data);
    } else {
      return $this->failNotFound('No Data Found with id '.$id);
    }
  }

  // add item
  // SERVER IP/canalette-backend/taxController/store/$year/$taxCitizen/$taxBusiness
  public function store($year, $taxCitizen, $taxBusiness) {
    $model = new TaxModel();
    $data = [
      'year' => $year,
      'taxCitizen'  => $taxCitizen,
      'taxBusiness'  => $taxBusiness,
    ];
    $model->insert($data);
    $response = [
      'status'   => 201,
      'error'    => null,
      'messages' => ['success' => 'Data Saved']
    ];
    return $this->respondCreated($response);
  }

  // delete item
  // 172.20.34.75/canalette-backend/taxController/delete/(:num)
  public function delete($id = null) {
    $model = new TaxModel();
    $data = $model->find($id);
    if ($data) {
      $model->delete($id);
      $response = array(
        'status'   => 200,
        'error'    => null,
        'messages' => array('success' => 'Item successfully deleted')
      );
      return $this->respondDeleted($response);
    } else {
      return $this->failNotFound('No Data Found with id '.$id);
    }
  }

  // update item
  // SERVER IP/canalette-backend/taxController/update/$year/$taxCitizen/$taxBusiness
  public function update($id = null, $taxCitizen, $taxBusiness) {
    $model = new TaxModel();
    $data = $model->find($id);
    if ($data) {
      $data = [
        'taxCitizen' => $taxCitizen,
        'taxBusiness' => $taxBusiness
      ];
      $model->update($id, $data);
      $response = array(
        'status'   => 200,
        'error'    => null,
        'messages' => array('success' => $id.' record updated')
      );
      return $this->respond($response);
    } else {
      return $this->failNotFound('No Data Found with id '.$id);
    }
  } 
}