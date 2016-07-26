<?php

namespace GA\CoreBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class LienAddType extends LienType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('dateCreate')
            ->remove('dateModif')
        ;
    }
    
    public function getParent()
    {
        return LienType::class;
    }
}
