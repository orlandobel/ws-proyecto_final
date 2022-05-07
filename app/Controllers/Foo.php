<?php
namespace App\Controllers;

use Symfony\Component\Routing\Annotation\Route;

class Foo {
    public function foo() {
        echo 'hello';
        return 'foo function';
    }

    public function hey() {
        return 'hey function';
    }

    public function params($id, $string=null) {
        echo $id."</br>";
        echo $string."</br>";
        return 'params function';
    }

}