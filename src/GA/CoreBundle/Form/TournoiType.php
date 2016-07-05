<?php

namespace GA\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


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
						
						->add('ronde',				CollectionType::class, array(
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
