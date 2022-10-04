<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AddBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', TextType::class, [
                'attr' => [
                    'class' => "form-control",
                ]
                
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => "form-control",
                ]
                
            ])
            ->add('isbn', TextType::class, [
                'attr' => [
                    'class' => "form-control",
                ]
                
            ])
            ->add('editor', TextType::class, [
                'attr' => [
                    'class' => "form-control",
                ]
                
            ])
            ->add('year', TextType::class, [
                'attr' => [
                    'class' => "form-control",
                ]
                
            ])
            ->add('country', TextType::class, [
                'attr' => [
                    'class' => "form-control",
                ]
                
            ])
            ->add('genre', TextType::class, [
                'attr' => [
                    'class' => "form-control",
                ]
                
            ])
            
            ->add('imageFile', VichImageType::class, [

                'label'=> 'Cover Picture',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
