<?php

namespace App\Form;

use App\Entity\Purchase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PurchaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('currency', TextType::class,[
            'label' =>'Quel Crypto money',
            'attr'=>[
                'placeholder'=>"laquelle"
            ]
        ])
        ->add('price', NumberType::class,[
            'label' =>'Prix d\'achat',
            'attr'=>[
                'placeholder'=>"Prix"
            ]
        ])
        ->add('quantity', NumberType::class,[
            'label' =>'Quantityé',
            'attr'=>[
                'placeholder'=>"Quantity"
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
            'data_class' => Purchase::class,
        ]);
    }
}
