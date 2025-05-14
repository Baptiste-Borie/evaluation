<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('destinataire', EntityType::class, [
                'class' => User::class,
                'choice_label' => fn(User $user) => $user->getFirstname() . ' ' . $user->getLastname(),
                'placeholder' => 'Sélectionner un destinataire',
            ])
            ->add('titre', TextType::class, [
                'label' => 'Objet',
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Message',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
