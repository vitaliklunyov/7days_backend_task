<?php

namespace App\Form;

use App\Dto\DateInputDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class DateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TextType::class, [
                'constraints' => [
                    new Regex(['pattern' => '/^\d{4}-\d{2}-\d{2}$/'])
                ]
            ])
            ->add('timezone', TextType::class, [
                'constraints' => [
                    new Regex(['pattern' => '/^\w+\/\w+$/'])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DateInputDto::class,
        ]);
    }
}
