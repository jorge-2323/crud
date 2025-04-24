<?php

namespace App\Form;

ini_set('max_execution_time', 120);

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    private const INPUT_STYLE = "form-control";

    private const LABEL_STYLE = "form-label mt-3 fw-bold text-dark";

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nombre',
                'required' => true,
                 'label_attr' => [
                    'class' => self::LABEL_STYLE,
                 ],
                 'attr' => [
                    'class' => self::INPUT_STYLE,
                    'if' => 'user_form_name',
                    'placeholder' => 'Escribe tu nombre aqui'     
                 ]
            ])
            ->add('lastname',TextType::class, [
                'label' => 'Apellido',
                'required' => true,
                 'label_attr' => [
                    'class' => self::LABEL_STYLE,
                 ],
                 'attr' => [
                    'class' => self::INPUT_STYLE,
                    'if' => 'user_form_lastname',
                    'placeholder' => 'Escribe tu Apellido aqui'     
                 ]
            ])
            ->add('email',TextType::class, [
                'label' => 'Correo electronico',
                'required' => true,
                 'label_attr' => [
                    'class' => self::LABEL_STYLE,
                 ],
                 'attr' => [
                    'class' => self::INPUT_STYLE,
                    'if' => 'user_form_email',
                    'placeholder' => 'Escribe tu Correo electronico aqui'     
                 ]
            ])
            ->add('phone',TextType::class, [
                'label' => 'Telefono',
                'required' => true,
                 'label_attr' => [
                    'class' => self::LABEL_STYLE,
                 ],
                 'attr' => [
                    'class' => self::INPUT_STYLE,
                    'if' => 'user_form_phone',
                    'placeholder' => 'Escribe tu telefono aqui'     
                 ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
