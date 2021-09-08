<?php namespace App\Controllers;

use Config\Services;
use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        helper('secure_password');
    }

    public function login()
    {
        try {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $usuarioModel = new UsuarioModel();
            $validateUsuario = $usuarioModel->where('username', $username)->first();
            
            if($validateUsuario == null)
                return $this->failNotFound('Usuario no encontrado');

            if(verifyPassword($password, $validateUsuario["password"])):
                $jwt = $this->generateJWT($validateUsuario);
                return $this->respond($jwt);

            else:
                return $this->failValidationErrors('Contraseña invalida');
            endif; 

        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor '.$e);
        }
    }

    protected function generateJWT()
    {
        $key = Services::getSecretKey();
        $time = time();

        $playload = [
            'aud' => base_url(),
            'ait' => $time, // como entero el tiempo,
            'exp' => $time + 60, // 
        ];

        $jwt = JWT::encode($playload, $key);
        return $jwt;
    }
}