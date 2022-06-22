<?php

namespace App\Form;

use App\Entity\AnswerQ;
use App\Entity\Assignment;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AnswerQType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Answer', FileType::class, 
            [
                'label'=> "Answer",
                'data_class'=> null,
                'required' => is_null($builder->getData()->getAnswer())     
            ])
            // ->add('Datesubmit', DateType::class, 
            // [
            //     'label' => 'Date Submit',
            //     'widget' => 'single_text'
                
            // ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=> Assignment::class
        ]);
    }
}