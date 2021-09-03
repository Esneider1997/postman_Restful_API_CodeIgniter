<?php namespace App\Controllers\API;

use App\Models\TipoTransaccionModel;
use CodeIgniter\RESTful\ResourceController;
use PhpParser\Node\Stmt\Return_;

class TiposTransaccion extends ResourceController
{
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function __construct()
	{
		$this->model = $this->setModel(new TipoTransaccionModel());
	}

	public function index()
	{
		$tipostransaccion = $this->model->findAll();
		return $this->respond($tipostransaccion);
	}
	
	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		try {
			$tipotransaccion = $this->model->getJSON();
			if($this->model->insert($tipotransaccion)):
				$tipotransaccion->id = $this->model->insertID();
				return $this->respondCreated($tipotransaccion);
			else:
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;
		} catch (\Exception $e) {
			
		}
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @return mixed
	 */
	public function edit($id = null)
	{
		//
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		//
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function delete($id = null)
	{
		//
	}
}
