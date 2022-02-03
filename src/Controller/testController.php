<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class testController
{

    /**
     * @Route("/movies", methods="GET")
     */
    public function index()
    {
        return new JsonResponse([
            [
                "name" => "zidane"
            ],
            [
                "name" => "test"
            ]
        ]);
    }

}