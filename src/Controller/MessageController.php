<?php

namespace App\Controller;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Form\MessageTypeForm;
use App\Repository\MessageRepository;

final class MessageController extends AbstractController
{
    #[Route('/message/new', name: 'app_message_new')]
    public function new(Request $request, EntityManagerInterface $em, UserInterface $user): Response
    {
        $message = new Message();
        $message->setEmetteur($user); // l'utilisateur connecté est l'émetteur
        $message->setDateHeure(new \DateTime()); // timestamp automatique

        $form = $this->createForm(MessageTypeForm::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($message);
            $em->flush();

            $this->addFlash('success', 'Message envoyé avec succès !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('message/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/message/inbox', name: 'app_message_inbox')]
    public function inbox(MessageRepository $messageRepository, UserInterface $user): Response
    {
        $messagesRecus = $messageRepository->findBy(
            ['destinataire' => $user],
            ['dateHeure' => 'DESC']
        );

        return $this->render('message/inbox.html.twig', [
            'messages' => $messagesRecus,
        ]);
    }

    #[Route('/message/{id}', name: 'app_message_show')]
    public function show(Message $message): Response
    {
        // Optionnel : empêcher de voir un message qui ne nous appartient pas
        if ($message->getDestinataire() !== $this->getUser()) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas consulter ce message.");
        }

        return $this->render('message/show.html.twig', [
            'message' => $message,
        ]);
    }
}
