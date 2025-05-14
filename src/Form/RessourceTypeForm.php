<?php

namespace App\Form;

use App\Entity\Etape;
use App\Entity\Ressource;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourceTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('presentation')
            ->add('support')
            ->add('nature')
            ->add('urlDocumentPhysique')
            ->add('etape', EntityType::class, [
                'class' => Etape::class,
                'choice_label' => 'descriptif', // ou 'descriptif'
                'label' => 'Étape associée',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressource::class,
        ]);
    }
}
