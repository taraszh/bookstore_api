<?php

namespace App\Validator;

use App\Exception\FileNotFound;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Validation;

class FileValidator
{
    public function validateBookCover(Request $request): array
    {
        $file = $request->files->get('cover');
        if (!$file) {
            throw new FileNotFound();
        }
        
        $fileConstraints = new File([
            'maxSize' => '2M',
            'maxSizeMessage' => 'The file is too big',
            'mimeTypes' => ['image/jpeg', 'image/png', 'image/jpg'],
            'mimeTypesMessage' => 'The format is incorrect',
        ]);

        $validator = Validation::createValidator();

        $constraintViolationList = $validator->validate($request->files->get('cover'), $fileConstraints);
        
        $errors = [];
        if ($constraintViolationList->count()) {
            foreach ($constraintViolationList as $item) {
                $errors[] = $item->getMessage();
            }
        }
        
        return $errors;
    }
}