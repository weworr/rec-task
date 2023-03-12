<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ExchangeValuesListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('page', IntegerType::class, [
                'constraints' => [
                    new Assert\PositiveOrZero(),
                ]
            ])
            ->add('limit', IntegerType::class, [
                'constraints' => [
                    new Assert\Positive(),
                ]
            ])
            ->add('sortBy', TextType::class)
            ->add('sortDirection', ChoiceType::class, [
                'choices' => [
                    'desc',
                    'asc',
                ],
                'invalid_message' => 'Value should be ASC (ascending) or DESC (descending)'
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $formEvent) {
                $data = $formEvent->getData();

                if (isset($data['sortDirection'])) {
                    $data['sortDirection'] = strtolower($data['sortDirection']);
                    $formEvent->setData($data);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'allow_extra_fields' => false,
        ]);
    }
}