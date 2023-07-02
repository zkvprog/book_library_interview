<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookController
{
    public function index(BookRepository $repository)
    {
        return new JsonResponse($repository->getMultiAuthorBookUsingDoctrine());
    }
}