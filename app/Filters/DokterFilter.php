<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DokterFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null) 
    {
        if (!session('id')) {
            return redirect()->to(base_url('login'));
        } 
        if (session('id')->role != 'dokter') {
            return redirect()->to(base_url('home'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {

    }
}

?>