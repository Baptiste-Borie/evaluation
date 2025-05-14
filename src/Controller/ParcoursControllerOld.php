<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ParcoursControllerOld extends AbstractController
{
    #[Route('/parcours', name: 'app_parcours')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à votre parcours.');
        }

        $parcours = $user->getParcours();

        if (!$parcours) {
            $this->addFlash('warning', 'Aucun parcours associé à votre compte.');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('parcours/index.html.twig', [
            'parcours' => $parcours,
            'etapes' => $parcours->getEtapes(),
        ]);
    }
}
