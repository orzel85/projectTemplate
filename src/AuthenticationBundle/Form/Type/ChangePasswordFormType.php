<?php

namespace AuthenticationBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use AuthenticationBundle\Model\ChangePassword;

class ChangePasswordFormType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('currentPassword', 'password', array(
            'required' => true,
            'invalid_message' => 'Current password is not valid',
            'constraints' => new UserPassword(),
            
        ));
        
        $builder->add('password', \Symfony\Component\Form\Extension\Core\Type\RepeatedType::class, array(
            'type' => \Symfony\Component\Form\Extension\Core\Type\PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'options' => array('attr' => array('class' => 'password-field')),
            'mapped' => false,
            'required' => true,
            'first_options'  => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat Password'),
        ));
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ChangePassword::$__CLASS__,
            'intention'  => 'change_password',
            'csrf_protection'  => false,
        ));
    }

    public function getName()
    {
        return 'change_password';
    }
    
}

