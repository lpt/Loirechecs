<?php

namespace GA\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class AfficheAddType extends AfficheType
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
        return AfficheType::class;
    }
}
