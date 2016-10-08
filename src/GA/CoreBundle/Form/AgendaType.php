<?php

namespace GA\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AgendaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
						->add('dateEvent',			DateTimeType::class)
            ->add('nom',							TextType::class)
            ->add('description',			TextType::class, array('required'    => false,))
            ->add('adresse',					TextType::class, array('required'    => false,))
            ->add('ville',							TextType::class, array('required'    => false,))
            ->add('contactNom',		TextType::class, array('required'    => false,))
            ->add('contactTph',			TextType::class, array('required'    => false,))
            ->add('contactMail',		TextType::class, array('required'    => false,))
						->add('save',					SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GA\CoreBundle\Entity\Agenda'
        ));
    }
}
