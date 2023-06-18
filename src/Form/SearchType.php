<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'required'  => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Search by name']
            ])
            ->add('status', ChoiceType::class, [
                'attr' => ['class' => 'form-select'],
                'choices'  => [
                    '- Search by Status -' => null,
                    'In Progress' => 'In Progress',
                    'Done' => 'Done',
                    'Blocked' => 'Blocked',
                ]
            ])
            ->add('url', null, [
                'required'  => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Search by Url']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
