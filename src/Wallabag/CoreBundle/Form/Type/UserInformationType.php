<?php

namespace Wallabag\CoreBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Wallabag\UserBundle\Entity\User;

class UserInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'config.form_user.name_label',
            ])
            ->add('email', EmailType::class, [
                'label' => 'config.form_user.email_label',
            ])
            ->add('emailTwoFactor', CheckboxType::class, [
                'required' => false,
                'label' => 'config.form_user.emailTwoFactor_label',
            ])
            ->add('googleTwoFactor', CheckboxType::class, [
                'required' => false,
                'label' => 'config.form_user.googleTwoFactor_label',
                'mapped' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'config.form.save',
            ])
            ->remove('username')
            ->remove('plainPassword')
        ;
    }

    public function getParent()
    {
        return RegistrationFormType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'update_user';
    }
}
