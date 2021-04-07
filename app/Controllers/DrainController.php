<?php

namespace App\Controllers;

use App\Models\DrainModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

class DrainController extends Controller {

/* $data = {
    ********************************* "id_drain": 1,
    "num": "402", 
    "street": "Via Roma 1",
    "fogl": "12",
    "map": "72@gmail.com"
 }

 $filter {
   "name_field": "id_drain",
   "value_field": xxxxxxxxx
 }
*/

  use ResponseTrait;

  // SERVER IP/canalette-backend/drain/list ***************** SHOW LIST ---------- OK ON POSTMAN
  public function index() {
    $model = new DrainModel();
    $data = $model->orderBy('num', 'DESC')->findAll();
    return $this->respond($data);
  }

  // show single item
  // SERVER IP/canalette-backend/drain/view/(:num)
  public function showItem($num = null) {
    $model = new DrainModel();
    $data = $model->getWhere(['num' => $num])->getResult();
    if ($data) {
      return $this->respond($data);
    } else {
      return $this->failNotFound('No Data Found with num '.$num);
    }
  }

  // SERVER IP/canalette-backend/drain/create *************** ADD DRAIN ---------- OK ON POSTMAN
  public function create() {
    $model = new DrainModel();
    $input = json_decode($this->request->getBody(), true);  //convert to associative array
    $saved = $model->save([
      'num' => $input['num'],
      'street' => $input['street'],
      'fogl' => $input['fogl'],
      'map'  => $input['map']
    ]);
    $response = [
      'status'   => 201,
      'error'    => null,
      'messages' => ['success' => 'Data Saved']
    ];
    return $this->respondCreated($response);
  }

  // SERVER IP/canalette-backend/drain/delete/(:num) ******* DELETE DRAIN -------- OK ON POSTMAN
  public function delete($id = null) {
    $model = new DrainModel();
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
  // SERVER IP/canalette-backend/drain/joined
  public function joined($filter){
    $model = new DrainModel();
    $data = $model->joined($filter);
    return $this->respond($data);
  }

  /* public function options(): Response {
    return $this->response->setHeader('Access-Control-Allow-Origin', '*') //for allow any domain, insecure
      ->setHeader('Access-Control-Allow-Headers', '*') //for allow any headers, insecure
      ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE') //method allowed
      ->setHeader('Content-type', 'text/html')
      ->setStatusCode(200); //status code
} */
}