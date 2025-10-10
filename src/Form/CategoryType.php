<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titleJson');

        $builder->get('titleJson')
            ->addModelTransformer(new CallbackTransformer(
                function (array $titleJson): string {
                    // transform the array to a string
                    return $titleJson["fr"] ?? "";
                },
                function (string $title): array {
                    // transform the string back to an array
                    return ["fr" => $title];
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
