<?php

namespace App\Form;

use App\Entity\Gains;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('value', NumberType::class,[
            'label' =>'Value',
            'attr'=>[
                'placeholder'=>"Value"
            ]
        ])
            ->add('submit', SubmitType::class,[
                'label'=>'Valider mon choix ',
                'attr'=>[
                    'class'=>'btn btn-primary btn-block'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gains::class,
        ]);
    }
}
