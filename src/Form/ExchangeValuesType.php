<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ExchangeValuesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first', IntegerType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'invalid_message' => 'This value should be integer',
            ])
            ->add('second', IntegerType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'invalid_message' => 'This value should be integer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'allow_extra_fields' => false,
        ]);
    }
}