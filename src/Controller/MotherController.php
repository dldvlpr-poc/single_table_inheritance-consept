<?php

namespace App\Controller;

use App\Entity\Mother;
use App\Form\MotherType;
use App\Repository\MotherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class MotherController extends AbstractController
{
    #[Route('/', name: 'app_mother_index', methods: ['GET'])]
    public function index(MotherRepository $motherRepository): Response
    {
        return $this->render('mother/index.html.twig', [
            'mothers' => $motherRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mother_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MotherRepository $motherRepository): Response
    {
        $mother = new Mother();
        $form = $this->createForm(MotherType::class, $mother);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motherRepository->save($mother, true);

            return $this->redirectToRoute('app_mother_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mother/new.html.twig', [
            'mother' => $mother,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mother_show', methods: ['GET'])]
    public function show(Mother $mother): Response
    {
        return $this->render('mother/show.html.twig', [
            'mother' => $mother,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mother_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mother $mother, MotherRepository $motherRepository): Response
    {
        $form = $this->createForm(MotherType::class, $mother);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motherRepository->save($mother, true);

            return $this->redirectToRoute('app_mother_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mother/edit.html.twig', [
            'mother' => $mother,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mother_delete', methods: ['POST'])]
    public function delete(Request $request, Mother $mother, MotherRepository $motherRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mother->getId(), $request->request->get('_token'))) {
            $motherRepository->remove($mother, true);
        }

        return $this->redirectToRoute('app_mother_index', [], Response::HTTP_SEE_OTHER);
    }
}
