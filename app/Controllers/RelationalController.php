<?php
namespace App\Controllers;
use App\Models\RelationalModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

/* FOR VALIDATION
https://www.studentstutorial.com/codeigniter/codeigniter-crud
 */

class RelationalController extends Controller {

  use ResponseTrait;

  // SERVER IP/canalette-backend/relational/list ****************** SHOW LIST ----------------------------------- POSTMAN OK
  public function index() {
    $model = new RelationalModel();
    $data['items'] = $model->orderBy('id_user', 'DESC')->findAll();
    return $this->respond($data);
  }

  // SERVER IP/canalette-backend/relational/view/(:num) *********** 
  public function showItem($id = null){ 
    $model = new RelationalModel();
    $data = $model->getWhere(['id' => $id])->getResult();
    if ($data) {
      return $this->respond($data);
    } else {
      return $this->failNotFound('No Data Found with id ' . $id);
    }
  }

  // SERVER IP/canalette-backend/relational/create 
  public function create() {
    //helper('form', 'url');
    $model = new RelationalModel();
    $input = json_decode($this->request->getBody(), true); 
    
    $validation = \Config\Services::validation(); 
    $val = $validation->run($input,'validationRelationalRules');
   
    if (!$val) {
      $responseErr = [
        'status'   => 400,
        'error'    => "error",
        'messages' => ['error' => 'La relazione esiste già']
      ];
      return $this->respondCreated($responseErr);
    } else {
      $saved = $model->insert([
        'paid' => $input['paid'],
        'amount_computed'  => $input['amount_computed'],
        'amount_paid'  => $input['amount_paid'],
        'id_user'  => $input['id_user'],
        'id_year'  => $input['id_year'],
        'id_drain'  => $input['id_drain']
      ]);
      $response = [
        'status'   => 201,
        'error'    => null,
        'messages' => ['success' => 'Data Saved']
      ];
      return $this->respondCreated($response);
    }
  }

  // SERVER IP/canalette-backend/relational/delete/(:num) ******** DELETE USER ----------------------------------- POSTMAN OK
  public function delete($id = null) {
    $model = new RelationalModel();
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
      return $this->failNotFound('No Data Found with id ' . $id);
    }
  }

  // update item
  // SERVER IP/canalette-backend/relational/update/$year/$taxCitizen/$taxBusiness
  public function update($input) {
    var_dump($input);
    $model = new RelationalModel();
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

  // SERVER IP/canalette-backend/user/join
  public function joined($filter) {
    $model = new RelationalModel();
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
