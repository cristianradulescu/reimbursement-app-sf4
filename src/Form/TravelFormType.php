<?php

namespace App\Form;

use App\Entity\Travel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TravelFormType
 * @package App\Form
 */
class TravelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('destination')
            ->add('purpose')
            ->add('dateStart', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('dateEnd', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('departureLeaveTime')
            ->add('destinationArrivalTime')
            ->add('destinationLeaveTime')
            ->add('departureArrivalTime')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Travel::class
        ]);
    }
}
