<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'=>'label.firstname'
            ])
            ->add('lastname', TextType::class, [
                'label'=> 'label.lastname'
            ])
            ->add('birthdate', DateType::class, [
                'format'=>'dd/MM/yyyy',
                'widget'=>'single_text',
                'label'=>'label.birthdate'
            ])
            ->add('country', CountryType::class, [
                'label'=>'label.country'
            ])
            ->add('reductPrice',CheckboxType::class,[
                'required' => false,
                'label'=>'label.reduced.price'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
            'translation_domain'=>'forms'
        ]);
    }
}
