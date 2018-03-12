<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\DocumentStatus;
use App\Entity\DocumentType;
use App\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DocumentFormType
 * @package App\Form
 */
class DocumentFormType extends AbstractType
{
    /**
     * @param FormInterface $form
     * @param string $child
     * @param object $value
     * @param string $class
     */
    protected function addReadonlyOrRegularField(FormInterface $form, string $child, object $value, string $class)
    {
        if (null === $value) {
            $form->add($child, EntityType::class, ['class' => $class]);
        } else {
            $form->add($child, TextType::class, ['data' => $value, 'disabled' => true]);
        }
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('employee', EntityType::class, ['class' => Employee::class]);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            /** @var Document $document */
            $document = $event->getData();
            $form = $event->getForm();
            $this->addReadonlyOrRegularField($form, 'type', $document->getType(), DocumentType::class);
            $this->addReadonlyOrRegularField($form, 'status', $document->getStatus(), DocumentStatus::class);

            if ($document->isTravel()) {
                $form->add('travel', TravelFormType::class);
            }

            if ($document->isReimbursement()) {
                $form->add('reimbursements', CollectionType::class, [
                    'entry_type' => ReimbursementFormType::class,
                    'entry_options' => ['label' => false],
                    'by_reference' => false
                ]);
            }
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
