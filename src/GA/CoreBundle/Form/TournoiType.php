<?php

namespace GA\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use GA\CoreBundle\Form\RondeType;
use GA\CoreBundle\Form\OneType;
use GA\CoreBundle\Form\ManyType;



class TournoiType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',						TextType::class)
            ->add('description',		TextareaType::class)
            ->add('contactNom',			TextType::class)
            ->add('contactTph',			TextType::class)
            ->add('contactMail',		TextType::class)
						
						->add('one',						OneType::class)
						
						->add('manys', CollectionType::class, array(
							'entry_type'		=> ManyType::class,
							'allow_add'			=> true,
							'allow_delete'	=> true
						))
						
						->add('rondes', CollectionType::class, array(
							'entry_type'		=> RondeType::class,
							'allow_add'			=> true,
							'allow_delete'	=> true
						))
						
						
						->add('save',						SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GA\CoreBundle\Entity\Tournoi'
        ));
    }
}
