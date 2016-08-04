<?php

namespace GA\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ResultatType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateCreate')
            ->add('dateModif')
            ->add('nom' ,								ChoiceType::class, array(
																									'choices'  => array(
																											'Resultat' => 'Resultat',
																											'Appariement' => 'Appariement',
																											'Liste particpants' => 'Liste participants'
																											),
																									'required'    => false,
																									'empty_data'  => 'Resultat'
																									,))
																							
            ->add('chemin', 						FileType::class, array('label' => '(fichier .html'))
						->add('sauvegarder',			SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GA\CoreBundle\Entity\Resultat'
        ));
    }
}
