<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    use ResponseTrait; /* Para responder a los errores */

    public function login()
    {
        try {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $usuarioModel = new UsuarioModel();
            $validateUsuario = $usuarioModel->where('username', $username)->find();

            if($validateUsuario == null)
                return $this->failNotFound('Usuario no encontrado');
            
            if(verifyPassword($password, $validateUsuario["password"])):
                return $this->respond('Usuario encontrado');
            else:
                return $this->failValidationErrors('Contraseña invalida');
            endif;

        } catch (\Throwable $th) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}