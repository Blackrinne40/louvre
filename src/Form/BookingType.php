<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',RepeatedType::class, [
                'type'=> EmailType::class,
                'invalid_message'=> 'invalid.message.email',
                'required'=> true,
                'first_options'=> array('label'=> 'label.email'),
                'second_options'=> array('label'=> "label.confirm.email")
            ])
            ->add('visit_date',DateType::class, [
                'widget' => 'single_text',
                'attr' => ['type'=> 'date'],
                'label'=>'label.visit.date'
            ])
            ->add('number_tickets', NumberType::class, [
                'label'=> 'label.quantity'
            ])
            ->add('visit_type', ChoiceType::class, [
                'help'=> "helper.visit.type",
                'label'=>'label.visit.type',
                'choices'=>[
                    'label.day'=>Booking::TYPE_DAY,
                    'label.half.day'=>Booking::TYPE_HALF_DAY
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
