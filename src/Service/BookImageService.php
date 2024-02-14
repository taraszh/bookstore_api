<?php

namespace App\Service;

use App\Model\UploadBookCoverRequest;
use App\Model\UploadCoverResponse;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;

class BookImageService
{
    public function __construct(
        private readonly BookRepository $bookRepository,
        private readonly UploadService $uploadService,
        
    ) {
    }
    
    public function uploadCover(int $id, Request $request): UploadCoverResponse
    {
        $file = $request->files->get('cover');
        $book = $this->bookRepository->getBook($id);
        $oldImage = $book->getImage();
        $link = $this->uploadService->uploadBookFile($id, $file);

        $book->setImage($link);

        $this->bookRepository->save($book);

        if (null !== $oldImage) {
            $this->uploadService->deleteBookFile($book->getId(), basename($oldImage));
        }

        return new UploadCoverResponse($link);
    }
}