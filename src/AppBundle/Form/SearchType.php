<?php

namespace AppBundle\Form;

use AppBundle\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerId', TextType::class,[
                'required'=>false,
            ])
            ->add('contractId', TextType::class,[
                'required'=>true,
            ])
            ->add('serviceStatus',ChoiceType::class,[
                'multiple' => true,
                'expanded' => true,
                'choices' => Service::$serviceStatuses
            ])
            ->add('send',SubmitType::class)
        ;
    }
}
