<?php

namespace App\Controllers;

use App\Models\TaxModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

class TaxController extends Controller {

  use ResponseTrait;

  // SERVER IP/canalette-backend/tax/list ****************** SHOW LIST ------------------------------ POSTMAN OK
  public function index() {
    $model = new TaxModel();
    $data = $model->orderBy('id_year', 'DESC')->findAll();
    return $this->respond($data);
  }

  // SERVER IP/canalette-backend/tax/view/(:num) *********** SHOW SINGLE ITEM BASED ON YEAR --------- POSTMAN OK
  public function showItem($year = null){ 
    $model = new TaxModel();
    $data = $model->getWhere(['id_year' => $year])->getResult();
    if ($data) {
      return $this->respond($data);
    } else {
      return $this->failNotFound('No Data Found with id ' . $year);
    }
  }

  // SERVER IP/canalette-backend/user/create *************** ADD USER ------------------------------- POSTMAN OK
  public function create() {
    $model = new TaxModel();
    $input = json_decode($this->request->getBody(), true);
    $saved = $model->insert([
      'id_year' => $input['id_year'],
      'taxBusiness' => $input['taxBusiness'],
      'taxCitizen' => $input['taxCitizen'],
      'ivaFull' => $input['ivaFull'],
      'ivaSplit' => $input['ivaSplit'],
      'ivaZero' => $input['ivaZero'],
      'mailing_money' => $input['mailing_money']
    ]);
    //$data = gettype($input['taxBusiness']);
    $response = [
      'status'   => 201,
      'error'    => null,
      'messages' => ['success' => 'Data Saved']
    ];
    return $this->respondCreated($saved);
  }


  // add item
  // SERVER IP/canalette-backend/taxController/store/$year/$taxCitizen/$taxBusiness
  /* public function store($year, $taxCitizen, $taxBusiness) {
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
  } */

  // SERVER IP/canalette-backend/tax/delete/(:num) ******** DELETE YEAR ----------------------------- POSTMAN OK
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