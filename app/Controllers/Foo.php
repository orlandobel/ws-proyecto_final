<?php
namespace App\Controllers;

use Symfony\Component\Routing\Annotation\Route;

class Foo {
    public function foo() {
        return View('foo');
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