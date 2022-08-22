<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la catégorie',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ecrire ici le nom'
                ]
            ])
            ->add('imagePath', FileType::class, [
                'label' => 'Image de la catégorie/Télécharger une image',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3m',
                        'maxSizeMessage' => 'Le fichier ne doit pas dépasser 3 mo en poids.',
                    ])
                ],
                // 'attr' => [
                //     'placeholder' => 'ajouter le chemin de l\'image içi'
                // ]  
            ])
            ->add('description');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
