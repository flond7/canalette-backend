<?php

namespace App\Controllers;

use App\Models\DrainModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class DrainController extends Controller {

/* $data = {
    ********************************* "id_drain": 1,
    "num": "402", 
    "street": "Via Roma 1",
    "fogl": "12",
    "map": "72@gmail.com"
 }

 $filter {
   "name_field": "id_user",
   "value_field": xxxxxxxxx
 }
*/

  use ResponseTrait;

  // show list
  // SERVER IP/canalette-backend/drain/list
  public function index() {
    $model = new DrainModel();
    $data['items'] = $model->orderBy('num', 'DESC')->findAll();
    return $this->respond($data);
  }

  // show single item
  // SERVER IP/canalette-backend/drain/view/(:num)
  public function showItem($id = null) {
    $model = new DrainModel();
    $data = $model->getWhere(['id_drain' => $id])->getResult();
    if ($data) {
      return $this->respond($data);
    } else {
      return $this->failNotFound('No Data Found with id '.$id);
    }
  }

  // add item
  // SERVER IP/canalette-backend/drain/create
  public function create() {
    //$data = var_dump($this->request->getJSON()); //gets object(stdClass
    $model = new DrainModel();
    $data = $this->request->getJSON();
    //$dataT = var_dump($this->request->getJSON());
    $model->insert($data);
    $response = [
      'status'   => 201,
      'error'    => null,
      'messages' => ['success' => 'Data Saved']
    ];
    return $this->respondCreated($response);
  }

  // delete item
  // SERVER IP/canalette-backend/drain/delete/(:num)
  public function delete($id = null) {
    $model = new DrainModel();
    $data = $model->find($id);
    //$dataT = var_dump($data);
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
  public function update($input) {
    var_dump($input);
    $model = new DrainModel();
    $id = intval($input["id_drain"]);
    $data = $model->find($id);
    if ($data) {
      $data = [
        "id_drain" => $input["id_drain"],
        "num" => $input["num"],
        "street" => $input["street"],
        "fogl" => $input["fogl"],
        "map" => $input["map"]
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

   // update item
  // SERVER IP/canalette-backend/user/join
  public function joined($filter){
    $model = new DrainModel();
    $data = $model->joined($filter);
    return $this->respond($data);
  }
}