<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Course;
use App\Entity\Lectures;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Class name',
                'required' => true
            ])
            ->add('StdQuantity', IntegerType::class, [
                'label' => 'Student Quantity',
                'required' => true,
                'attr' => [
                    'min' => 20,
                    'max' => 25
                ]
            ])
            ->add('lecturer', EntityType::class, [
                'label' => 'Lecture',
                'class' => Lectures::class,
                'choice_label' => 'name',
                'multiple' => false,
            ])
            ->add('students', EntityType::class, [
                'label' => 'Student',
                'class' => Student::class,
                'choice_label' => 'name',
                'multiple' => false,
            ])
            ->add('course', EntityType::class, [
                'label' => 'Course',
                'class' => Course::class,
                'choice_label' => 'name',
                'multiple' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classes::class,
        ]);
    }
}
