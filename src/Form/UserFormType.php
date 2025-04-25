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
                'label' => 'Nombre de tarea',
                'required' => $options["is_edit"] ? true : false,
                 'label_attr' => [
                    'class' => self::LABEL_STYLE,
                 ],
                 'attr' => [
                    'class' => self::INPUT_STYLE,
                    'if' => 'user_form_name',
                    'placeholder' => ''     
                 ]
            ])
            ->add('lastname',TextType::class, [
                'label' => 'Nivel',
                'required' => $options["is_edit"] ? true : false,
                 'label_attr' => [
                    'class' => self::LABEL_STYLE,
                 ],
                 'attr' => [
                    'class' => self::INPUT_STYLE,
                    'if' => 'user_form_lastname',
                    'placeholder' => ''     
                 ]
            ])
            ->add('email',TextType::class, [
                'label' => 'Correo electronico',
                'required' => $options["is_edit"] ? true : false,
                 'label_attr' => [
                    'class' => self::LABEL_STYLE,
                 ],
                 'attr' => [
                    'class' => self::INPUT_STYLE,
                    'if' => 'user_form_email',
                    'placeholder' => ''     
                 ]
            ])
            ->add('phone',TextType::class, [
                'label' => 'Telefono',
                'required' => $options["is_edit"] ? true : false,
                 'label_attr' => [
                    'class' => self::LABEL_STYLE,
                 ],
                 'attr' => [
                    'class' => self::INPUT_STYLE,
                    'if' => 'user_form_phone',
                    'placeholder' => ''     
                 ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            "is_edit" => false,
        ]);
    }
}
