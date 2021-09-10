<?php namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use DeepCopy\Filter\Filter;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class AuthFilter implements FilterInterface
{
    use ResponseTrait;
    public function before(RequestInterface $request, $arguments = null)
    {
        try {
            $key = Services::getSecretKey();
            $authHeader = $request->getServer('HTTP_AUTHORIZATION');

            if($authHeader ==null)
                return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED,' No se ha enviado el JWT requerido');

            $arr = explode(' ', $authHeader);
            $jwt =  $arr[1];

            JWT::decode($jwt, $key, ['HS256']);
        } catch (ExpiredException $ee) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED,'Su Token JWT ha expirado '.$ee);
        } catch (\Exception $e) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,'Ocurrio un error en el servidor al validar el token');
        }
    }

	
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }

}