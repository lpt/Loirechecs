<?php

namespace GA\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use GA\CoreBundle\Form\RondeType;


class TournoiType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',					TextType::class)
            ->add('description',	TextareaType::class)
            ->add('contactNom',		TextType::class)
            ->add('contactTph',		TextType::class)
            ->add('contactMail',	TextType::class)
						->add('jeune',					ChoiceType::class, array(
																									'choices'  => array(
																											'Adulte' => 'Adulte',
																											'Jeune' => 'Jeune',
																											),
																									'required'    => true,
																									'label' => 'Catégorie'
																									)	)
						
						
						->add('saison',					ChoiceType::class, array(
																									'choices'  => array(
																											'2017-2018' => '2017-2018',
																											'2016-2017' => '2016-2017',
																											'2015-2016' => '2015-2016',
																											'2014-2015' => '2014-2015',
																											'2013-2014' => '2013-2014',
																											),
																									'required'    => true,
																									'preferred_choices' => array('2016-2017')
																									,))	
						
						
            ->add('rondes',				CollectionType::class, array(
							'entry_type'		=> 	RondeType::class,
							'allow_add'			=>	true,
							'allow_delete'	=>	true
						))
						
						->add('save',					SubmitType::class)
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
