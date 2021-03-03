<?php

namespace App\Controllers;

use App\Models\TaxModel;
use CodeIgniter\Controller;

class TaxController extends Controller
{
  // validation should be frontend
  

  
  public function index() {;
    /* $data = [
      'tariffe' => $model->getTax(),
      'title' => 'random text',
    ]; */   
    $model = new TaxModel();
    $data['taxes'] = $model->getTax();
    return view('api/taxView',$data);
  }

  public function create() {
    $model = new TaxModel();
    return view('subjects/create');
  }

  /*
  172.20.34.75/canalette-backend/taxController/store/$year/$taxCitizen/$taxBusiness
  */
  public function store($year, $taxCitizen, $taxBusiness) {
    $model = new TaxModel();
    //validate data



    $model->store($year, $taxCitizen, $taxBusiness);


    /* $request = service('request');
    $postData = $request->getPost(); */

    $data['new'] = [$year, $taxCitizen, $taxBusiness];
    return view('api/taxView',$data);

    /* if(isset($postData['submit'])){

      ## Validation
      $input = $this->validate([
         'year' => 'required|min_length[3]',
         'description' => 'required'
      ]);

      if (!$input) {
         return redirect()->route('subjects/create')->withInput()->with('validation',$this->validator); 
      } else {

         $subjects = new Subjects();

         $data = [
            'name' => $postData['name'],
            'description' => $postData['description']
         ];

         ## Insert Record
         if($subjects->insert($data)){
            session()->setFlashdata('message', 'Added Successfully!');
            session()->setFlashdata('alert-class', 'alert-success');

            return redirect()->route('subjects/create'); 
         }else{
            session()->setFlashdata('message', 'Data not saved!');
            session()->setFlashdata('alert-class', 'alert-danger');

            return redirect()->route('subjects/create')->withInput(); 
         }

      }
   } */
  }









  public function edit() {
    $model = new TaxModel();
  }

  public function udpate() {
    $model = new TaxModel();
  }

}
