<?php
namespace App\Controllers;

use App\Controllers\Base\Controller;
use Symfony\Component\HttpFoundation\Request;


class Foo extends Controller {

    public function foo(Request $request) {
        return $this->render('foo');
    }

    public function hey(Request $request, $id) {
        $data = $request->request->all();
        dd($request);
        return $this->render('foo');
    }

    public function params(Request $request, $id, $string) {

        $data = [
            'id' => $id,
            'string' => $string,
        ];

        return $this->render('templating', $data);
    }

}