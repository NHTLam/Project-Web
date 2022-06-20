<?php

namespace App\Form;

use App\Entity\Submit;
use App\Entity\Assignment;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Answer', TextType::class, 
            [
                'label'=> "Answer"
            ])
            ->add('Datesubmit', DateType::class, 
            [
                'label' => 'Date Submit'
            ])
            ->add('Assignment', EntityType::class, 
            [
                'label'=> 'Assignment',
                'required' => true,
                'class' => Assignment::class,
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
            'data_class'=> Answer::class
        ]);
    }
}