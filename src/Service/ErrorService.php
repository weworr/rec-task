<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;

class ErrorService
{
    public function getFormErrors(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors(true) as $error) {
            $fieldName = $error->getOrigin()->getName();
            $errors[$fieldName] = $error->getMessage();
        }

        return $errors;
    }
}