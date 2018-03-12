<?php

namespace App\Form;

use App\Entity\Reimbursement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ReimbursementFormType
 * @package App\Form
 */
class ReimbursementFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('employee');
        $builder->add('type');
        $builder->add('value');
        $builder->add('number');
        $builder->add('date', DateType::class, [
            'widget' => 'single_text'
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reimbursement::class
        ]);
    }
}