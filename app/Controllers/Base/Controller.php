<?php
namespace App\Controllers\Base;

Use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Symfony\Component\HttpFoundation\Response;
use Exception;

class Controller {
    private $twig;

    public function __construct() {
        $this->initTwig();
    }

    private function initTwig() {
        $options = [
            'cache' => APP_PATH.'/cache/twig',
            'auto_reload' => true,
        ];

        $loader = new FileSystemLoader(VIEWS_PATH);
        $this->twig = new Environment($loader, $options);
    }

    public function render(string $view, $data = []) {
        try {
            $load = $this->twig->render("$view.html.twig", $data);
            echo $load;
            exit();
            //return new Response($load, Response::HTTP_OK);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}