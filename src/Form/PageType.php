<?php

namespace App\Form;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Entity\Page;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $category = $options['category'];
        $builder
            ->add('titleJson')
            ->add('contentJson')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choices' => [$category],
                'choice_label' => 'titleJson[fr]',
                'row_attr' => [
                    'class' => 'hidden'
                ],
            ])
        ;

        $builder->get('titleJson')
            ->addModelTransformer(new CallbackTransformer(
                function (?array $titleJson): string {
                    // transform the array to a string
                    return $titleJson["fr"] ?? "";
                },
                function (string $title): array {
                    // transform the string back to an array
                    return ["fr" => $title];
                }
            ));

        $builder->get('contentJson')
            ->addModelTransformer(new CallbackTransformer(
                function (?array $contentJson): string {
                    return $contentJson['fr'] ?? '';
                },
                function (string $content): array {
                    return ['fr' => $content];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
            'category' => null
        ]);
    }
}
