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
}
