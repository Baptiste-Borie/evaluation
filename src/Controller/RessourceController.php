<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Ressource;
use App\Form\RessourceTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


final class RessourceController extends AbstractController
{
    #[Route('/ressource', name: 'app_ressource')]
    public function index(): Response
    {
        return $this->render('ressource/index.html.twig', [
            'controller_name' => 'RessourceController',
        ]);
    }

    #[Route('/ressource/new', name: 'app_ressource_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $ressource = new Ressource();
        $form = $this->createForm(RessourceTypeForm::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ressource);
            $em->flush();

            $this->addFlash('success', 'Ressource créée avec succès !');
            return $this->redirectToRoute('app_ressource_new');
        }

        return $this->render('ressource/new.html.twig', [
            'form' => $form,
        ]);
    }
}
