<?php

namespace App\Form;

use App\Entity\Product;

use App\Entity\Category;
use App\Entity\Color;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ecrire ici le nom...'
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du produit',
                'required' => false,
                'divisor' => 100
            ])
            ->add('ImagePath', TextType::class, [
                'label' => 'Image du produit',
                'required' => false,
                'attr' => [
                    'placeholder' => 'ajouter le chemin de l\'image içi'
                ]
            ])
            ->add('style', TextType::class, [
                'label' => 'Style du produit',
                'required' => false,
            ])
            ->add('season')
            ->add('color', EntityType::class, [
                'label' => 'Choisir la couleur',
                'placeholder' => '-- Choisir --',
                'class' => Color::class
            ])
            ->add('size')
            ->add('quantity')
            ->add('created_at')
            ->add('category', EntityType::class, [
                'label' => 'Choisir la catégorie',
                'placeholder' => '--Choisir--',
                'class' => Category::class
            ])
            ->add('productSizes')
            ->add('description', TextareaType::class, [
                'label' => 'Descriptif du produit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
