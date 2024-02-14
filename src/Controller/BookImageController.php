<?php

namespace App\Controller;

use App\Service\BookImageService;
use App\Validator\FileValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class BookImageController extends AbstractController
{
    public function __construct(
        private readonly BookImageService $bookImageService,
        private readonly FileValidator $validator,
    ) {
    }

    #[Route(path: '/api/book/{id}/cover', name: 'book_cover_post', methods: ['POST'])]
    public function uploadCover(
        int $id,
        Request $request
    ): JsonResponse {
        $errors = $this->validator->validateBookCover($request);

        if (!empty($errors)) {
            return $this->json($errors);
        }

        
        return $this->json($this->bookImageService->uploadCover($id, $request));
    }
    
}