<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'attr' => ['class' => 'form-control'],
                'required'  => true
            ])
            ->add('image', FileType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Image (fichier image)',
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
                'data_class' => null,
            ])
            ->add('url', null, [
                'attr' => ['class' => 'form-control'],
                'required'  => true
            ])
            ->add('description', null, [
                'attr' => ['class' => 'form-control'],
                'required'  => true
            ])
            ->add('numberOfTasks', NumberType::class, [
                "attr" => [
                    "placeholder" => "Number Of Tasks",
                    'class' => 'form-control',
                    'required'  => true
                ]
            ])
            ->add('status', ChoiceType::class, [
                'attr' => ['class' => 'form-select'],
                'choices'  => [
                    'In Progress' => 'In Progress',
                    'Done' => 'Done',
                    'Blocked' => 'Blocked',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
