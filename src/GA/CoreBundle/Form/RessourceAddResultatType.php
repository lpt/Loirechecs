<?php

namespace GA\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RessourceAddResultatType extends RessourceType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
						->remove('type')
            ->remove('dateCreate')
            ->remove('dateModif')
						->remove('url')
						->remove('nom')
						
						
        ;
    }
    
     public function getParent()
    {
        return RessourceType::class;
    }
}
