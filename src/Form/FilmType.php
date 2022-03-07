<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Artiste;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom'
            ])
            ->add('realisateur', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom'
            ])
            ->add('acteurs', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => "nom",
                'multiple' =>  true,
                'expanded' => true
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => "nom",
                'multiple' =>  true,
                'expanded' => true
            ])
            ->add('photoFile', VichImageType::class, [
                'label' => 'photoFile', 
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => false
            ])
        ;

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
