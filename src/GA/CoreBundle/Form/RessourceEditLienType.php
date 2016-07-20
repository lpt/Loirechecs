<?php

namespace GA\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RessourceAddLienType extends RessourceType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('lien')
						->remove('type')
            ->remove('dateCreate')
            ->remove('dateModif')
						->remove('Lien')
						->remove('Resultat')
        ;
    }
    
     public function getParent()
    {
        return RessourceType::class;
    }
}
