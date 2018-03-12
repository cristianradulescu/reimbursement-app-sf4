<?php

namespace App\Form;

use App\Entity\Travel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
                'widget' => 'single_text',
                'format' => 'Y-MM-dd'
            ])
            ->add('dateEnd', DateType::class, [
                'widget' => 'single_text',
                'format' => 'Y-MM-dd'
            ])
            ->add('departureLeaveTime', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'Y-MM-dd HH:mm'
            ])
            ->add('destinationArrivalTime', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'Y-MM-dd HH:mm'
            ])
            ->add('destinationLeaveTime', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'Y-MM-dd HH:mm'
            ])
            ->add('departureArrivalTime', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'Y-MM-dd HH:mm'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Travel::class
        ]);
    }
}
