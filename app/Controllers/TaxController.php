<?php

namespace App\Controllers;

use App\Models\TaxModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

class TaxController extends Controller {

  use ResponseTrait;

  // SERVER IP/canalette-backend/tax/list ****************** SHOW LIST
  public function index() {
    $model = new TaxModel();
    $data = $model->orderBy('id_year', 'DESC')->findAll();
    return $this->respond($data);
  }

  // SERVER IP/canalette-backend/tax/view/(:num) *********** SHOW SINGLE ITEM BASED ON YEAR
  public function showItem($year = null){ 
    $model = new TaxModel();
    $data = $model->getWhere(['id_year' => $year])->getResult();
    if ($data) {
      return $this->respond($data);
    } else {
      return $this->failNotFound('No Data Found with id ' . $year);
    }
  }

  // SERVER IP/canalette-backend/user/create *************** ADD USER
  public function create() {
    $model = new TaxModel();
    $input = json_decode($this->request->getBody(), true);
    $saved = $model->save([
      'id_year' => $input['id_year'],
      'taxBusiness' => $input['taxBusiness'],
      'taxCitizen' => $input['taxCitizen']
    ]);
    $response = [
      'status'   => 201,
      'error'    => null,
      'messages' => ['success' => 'Data Saved']
    ];
    return $this->respondCreated($response);
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