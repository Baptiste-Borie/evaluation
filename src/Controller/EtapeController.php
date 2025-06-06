<?php

namespace App\Controller;

use App\Entity\Etape;
use App\Form\EtapeForm;
use App\Repository\EtapeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/etape')]
final class EtapeController extends AbstractController
{
    #[Route(name: 'app_etape_index', methods: ['GET'])]
    public function index(EtapeRepository $etapeRepository): Response
    {
        return $this->render('etape/index.html.twig', [
            'etapes' => $etapeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etape_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etape = new Etape();
        $form = $this->createForm(EtapeForm::class, $etape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etape);
            $entityManager->flush();

            return $this->redirectToRoute('app_etape_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etape/new.html.twig', [
            'etape' => $etape,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etape_show', methods: ['GET'])]
    public function show(Etape $etape): Response
    {
        return $this->render('etape/show.html.twig', [
            'etape' => $etape,

        ]);
    }

    #[Route('/{id}/edit', name: 'app_etape_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etape $etape, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtapeForm::class, $etape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_etape_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etape/edit.html.twig', [
            'etape' => $etape,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etape_delete', methods: ['POST'])]
    public function delete(Request $request, Etape $etape, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $etape->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($etape);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_etape_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/parcours/{id}/add-etape', name: 'app_etape_add_to_parcours', methods: ['GET', 'POST'])]
    public function addToParcours(Request $request, \App\Entity\Parcours $parcours, EntityManagerInterface $em): Response
    {
        $etape = new Etape();
        $etape->setParcours($parcours);

        // Déterminer la prochaine position disponible
        $positions = $parcours->getEtapes()->map(fn($e) => $e->getPosition())->toArray();
        $maxPosition = !empty($positions) ? max($positions) : 0;
        $etape->setPosition($maxPosition + 1);

        $form = $this->createForm(EtapeForm::class, $etape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($etape);
            $em->flush();

            $this->addFlash('success', 'Étape ajoutée au parcours avec succès !');
            return $this->redirectToRoute('app_parcours');
        }

        return $this->render('etape/new.html.twig', [
            'etape' => $etape,
            'form' => $form,
            'parcours' => $parcours,
        ]);
    }
}
