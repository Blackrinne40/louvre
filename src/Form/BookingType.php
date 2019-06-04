<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add('visit_date',DateType::class, [
//                'format'=>'dd/MM/yy',
                'widget' => 'single_text',
                'attr' => ['type'=> 'date']
                //'html5' => false,
               // 'attr' => ['class' => 'js-datepicker']
            ])
            ->add('number_tickets')
            ->add('visit_type', ChoiceType::class, [
                'choices'=>[
                    'Journée'=>Booking::TYPE_DAY,
                    'Demi-journée'=>Booking::TYPE_HALF_DAY
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
            'translation_domain'=>'forms'
        ]);
    }
}
