<?php

namespace App\Controllers;

use App\Models\TariffeModel;
use CodeIgniter\Controller;

class TariffeController extends Controller
{
  public function index() {
    $model = new TariffeModel();
    $data = [
      'tariffe' => $model->getTariffe(),
      'title' => 'random text',
    ];

    echo view('templates/header', $data);
    echo view('api/TariffeView', $data);
    echo view('templates/footer', $data);

    //$this->output->set_content_type('application/json')->set_output(json_encode($data,JSON_PRETTY_PRINT));
 
  }

  public function view($slug = null) {
    $model = new TariffeModel();
    $data['tariffe'] = $model->getTariffe($slug);
  }


  function add() {
		return view('add_data');
	}

  function add_validation() {
		helper(['form', 'url']);

		$error = $this->validate([
			'anno'	=>	'required|min_length[4]',
			'impostaAzienza'	=>	'required',
			'impostaPrivato'=>	'required'
		]);

		if(!$error) {
			echo view('add_data', [
				'error' 	=> $this->validator
			]);
		} else {
			$model = new TariffeModel();

			$model->save([
				'anno'	=>	$this->request->getVar('anno'),
				'impostaAzienza'	=>	$this->request->getVar('impostaAzienza'),
				'impostaPrivato'=>	$this->request->getVar('impostaPrivato')
			]);

			$session = \Config\Services::session();
			$session->setFlashdata('success', 'User Data Added');

			return $this->response->redirect(site_url('/crud'));
		}
	}

  // create New Tariffa
  public function create() {
    $model = new TariffeModel();

    if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body'  => 'required',
        ]))
    {
        $model->save([
            'title' => $this->request->getPost('title'),
            'slug'  => url_title($this->request->getPost('title'), '-', TRUE),
            'body'  => $this->request->getPost('body'),
        ]);
        echo view('news/success');
    } else {
      echo view('api/TariffeView', $data);
    }
  }

}
