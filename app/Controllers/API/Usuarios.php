<?php namespace App\Controllers\API;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class Usuarios extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new UsuarioModel());
    }

    public function index()
    {
        $usuarios = $this->model->findAll();
		return $this->respond($usuarios);       /* Permite contestar todas respuestas http, 100x, 200x, 300x, 400x */
    }

    public function create()
    {
        try {
            $usuario = $this->request->getJSON();
            if($this->model->insert($usuario)):
                $usuario->id = $this->model->insertID();
                return $this->respondCreated($usuario);
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Throwable $th) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function edit($id = null)
    {
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un ID valido');
            $usuario = $this->model->find($id);
            if($usuario == null)
                return $this->failNotFound('No se ha encontrado un cliente con el id: '.$id);
            return $this->respond($usuario);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function update($id = null)
    {
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha encontrado un ID valido');
            
            $usuarioVerificado = $this->model->find($id);
            if($usuarioVerificado == null)
                return $this->failValidationErrors('No se ha encontrado un cliente con el ID '.$id);
            
            $usuario = $this->request->getJSON();

            if($this->model->update($id, $usuario)):
                $usuario->id = $id;
                return $this->respondUpdated($usuario);
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }

    }

    public function delete($id = null)
    { 
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha encontrado un ID valido');
                
            $usuarioVerificado = $this->model->find($id);
            if($usuarioVerificado == null)
                return $this->failValidationErrors('No se ha encontrado un cliente con el ID '.$id);
            
            if ($this->model->delete($id)):
                return $this->respondDeleted($usuarioVerificado);
            else:
                return $this->failServerError('No se ha podido elimar el registro');
			endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un problema en el servidor '.$e);
        } 
    }
}
