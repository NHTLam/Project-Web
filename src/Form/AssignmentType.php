<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\Assignment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AssignmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Title', TextType::class,
            [
                'label'=> 'Title'
            ])
            ->add('file', FileType::class, 
            [
                'label' => 'File Assignment',
                'data_class' => null,
                'required'=>is_null($builder->getData()->getFile())
            ])
            ->add('DateSubmit', TextType::class, 
            [
                'label' => 'Deadline',
                'widget' => 'single_text'
            ] )
            ->add('Student', EntityType::class, 
            [
                'label'=> 'Student',
                'required' => true,
                'class' => Student::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=> Assignment::class
        ]);
    }
}
