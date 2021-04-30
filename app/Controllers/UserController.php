<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Message;
use CodeIgniter\HTTP\Response;

/* FOR VALIDATION
https://www.studentstutorial.com/codeigniter/codeigniter-crud
 */

class UserController extends Controller {

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

  // SERVER IP/canalette-backend/user/create *************** ADD USER -------------------------------------- POSTMAN OK
  public function create() {
    $model = new UserModel();
    $input = json_decode($this->request->getBody(), true); //convert to associative array
    
    $validation = \Config\Services::validation();
    $val = $validation->run($input, 'validationUserRules');     
  
    /* {'first_name':"el", 'last_name':"ln",'cf':'cf', 'email':"",'tel':"",'category':"citizen"} */ 
    if (!$val) {
      $responseErr = [
        'status'   => 400,
        'error'    => "error",
        'messages' => ['error' => "L'utente esiste già"]
      ];
      
      return $this->failValidationError($responseErr['error'], $responseErr['messages']);
//      return $this->respondCreated($responseErr);  
    } else {
      //eventually change to insert
      $saved = $model->save([
        'first_name' => $input['first_name'],
        'last_name' => $input['last_name'],
        'cf' => $input['cf'],
        'email'  => $input['email'],
        'tel' => $input['tel'],
        'category' => $input['category'],
        'tax_type' => $input['tax_type']
      ]);
      $response = [
        'status'   => 201,
        'error'    => null,
        'messages' => ['success' => 'Data Saved']
      ];
      return $this->respondCreated($response);
    } 
  }
  // SERVER IP/canalette-backend/user/delete/(:num) ******** DELETE USER ----------------------------------- POSTMAN OK
  public function delete($id = null) {
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

  public function options(): Response {
    return $this->response->setHeader('Access-Control-Allow-Origin', '*') //for allow any domain, insecure
        ->setHeader('Access-Control-Allow-Headers', '*') //for allow any headers, insecure
        ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE') //method allowed
        ->setStatusCode(200); //status code
  }
}
