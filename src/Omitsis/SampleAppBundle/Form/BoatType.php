<?php

namespace Omitsis\SampleAppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('active')
            ->add('owner')
            ->add('city')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Omitsis\SampleAppBundle\Entity\Boat'
        ));
    }

    public function getName()
    {
        return 'omitsis_sampleappbundle_boattype';
    }
}
