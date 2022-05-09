<?php
namespace App\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controllers\Base\Controller;
use Symfony\Component\HttpFoundation\Response;

class Foo extends Controller {

    public function __construct() {
        parent::__construct();
    }
    public function foo() {
        return $this->render('foo');;
        
        //return View('foo');
    }

    public function hey($id) {
        return View('foo', ['id' => $id]);
    }

    public function params($id, $string=null) {
        $arguments = [
            'id' => $id,
            'string' => $string,
        ];
        return View('foo', $arguments);
    }

}