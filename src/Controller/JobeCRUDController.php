<?php

namespace App\Controller;

use App\Entity\Jobe;
use App\Form\Jobe1Type;
use App\Repository\JobeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/jobe/c/r/u/d')]
final class JobeCRUDController extends AbstractController
{
    #[Route(name: 'app_jobe_c_r_u_d_index', methods: ['GET'])]
    public function index(JobeRepository $jobeRepository): Response
    {
        return $this->render('jobe_crud/index.html.twig', [
            'jobes' => $jobeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_jobe_c_r_u_d_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jobe = new Jobe();
        $form = $this->createForm(Jobe1Type::class, $jobe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobe);
            $entityManager->flush();

            return $this->redirectToRoute('app_jobe_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jobe_crud/new.html.twig', [
            'jobe' => $jobe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jobe_c_r_u_d_show', methods: ['GET'])]
    public function show(Jobe $jobe): Response
    {
        return $this->render('jobe_crud/show.html.twig', [
            'jobe' => $jobe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jobe_c_r_u_d_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Jobe $jobe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Jobe1Type::class, $jobe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_jobe_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jobe_crud/edit.html.twig', [
            'jobe' => $jobe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jobe_c_r_u_d_delete', methods: ['POST'])]
    public function delete(Request $request, Jobe $jobe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobe->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($jobe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_jobe_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
    }
}
