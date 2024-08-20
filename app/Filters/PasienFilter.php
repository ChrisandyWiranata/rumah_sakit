<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PasienFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null) 
    {
        if (!session('id')) {
            return redirect()->to(base_url('login'));
        } 
        if (session('id')->role != 'pasien') {
            return redirect()->to(base_url('home'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {

    }
}

?>