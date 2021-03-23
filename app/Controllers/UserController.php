<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

/* FOR VALIDATION
https://www.studentstutorial.com/codeigniter/codeigniter-crud
 */


class UserController extends Controller
{

  /* $data = {
    ********************************* "id_user": 1,
    "first_name": "Elisa", 
    "last_name": "Pessa",
    "cf": "1234567891234567",
    "email": "elisa@gmail.com",
    "tel": "12345678",
    "category": "business"
 }

 $filter {
   "name_field": "id_user",
   "value_field": xxxxxxxxx
 }
*/

  use ResponseTrait;

  // SERVER IP/canalette-backend/user/list ****************** SHOW LIST
  public function index() {
    $model = new UserModel();
    $data['items'] = $model->orderBy('surname', 'DESC')->findAll();
    return $this->respond($data);
  }

  // SERVER IP/canalette-backend/user/view/(:num) *********** SHOW SINGLE ITEM BASED ON CF
  public function showItem($cf = null){ 
    $model = new UserModel();
    $data = $model->getWhere(['cf' => $cf])->getResult();
    if ($data) {
      return $this->respond($data);
    } else {
      return $this->failNotFound('No Data Found with id ' . $cf);
    }
  }

  // SERVER IP/canalette-backend/user/create *************** ADD USER
  public function create() {
    $model = new UserModel();
    //convert request body to associative array
    $input = json_decode($this->request->getBody(), true);
    //$data = gettype($input);
    $saved = $model->save([
      'first_name' => $input['first_name'],
      'last_name' => $input['last_name'],
      'cf' => $input['cf'],
      'email'  => $input['email'],
      'tel' => $input['tel'],
      'category' => $input['category']
    ]);
    $response = [
      'status'   => 201,
      'error'    => null,
      'messages' => ['success' => 'Data Saved']
    ];
    return $this->respondCreated($response);
  }

  public function options(): Response {
      return $this->response->setHeader('Access-Control-Allow-Origin', '*') //for allow any domain, insecure
          ->setHeader('Access-Control-Allow-Headers', '*') //for allow any headers, insecure
          ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE') //method allowed
          ->setStatusCode(200); //status code
  }


  // delete item
  // SERVER IP/canalette-backend/user/delete/(:num)
  public function delete($id = null)
  {
    $model = new UserModel();
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
      return $this->failNotFound('No Data Found with id ' . $id);
    }
  }

  // update item
  // SERVER IP/canalette-backend/taxController/update/$year/$taxCitizen/$taxBusiness
  public function update($input) {
    var_dump($input);
    $model = new UserModel();
    $id = intval($input["id_user"]);
    $data = $model->find($id);
    if ($data) {
      $data = [
        "id_user" => $input["id_user"],
        "first_name" => $input["first_name"],
        "last_name" => $input["last_name"],
        "cf" => $input["cf"],
        "email" => $input["email"],
        "tel" => $input["tel"],
        "category" => $input["category"]
      ];
      $model->update($id, $data);
      $response = array(
        'status'   => 200,
        'error'    => null,
        'messages' => array('success' => $id . ' record updated')
      );
      return $this->respond($response);
    } else {
      return $this->failNotFound('No Data Found with id ' . $id);
    }
  }

  // update item
  // SERVER IP/canalette-backend/user/join
  public function joined($filter) {
    $model = new UserModel();
    $data = $model->joined($filter);
    return $this->respond($data);
  }
}
