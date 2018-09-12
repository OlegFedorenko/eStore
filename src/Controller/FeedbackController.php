<?php

namespace App\Controller;

use App\Entity\FeedbackRequest;
use App\Form\FeedbackType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/feedback", name="feedback")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $feedbackRequest = new FeedbackRequest();


        $form = $this->createForm(FeedbackType::class, $feedbackRequest);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($feedbackRequest); //связываем с БД
            $entityManager->flush(); // сохраняем в БД

            $this->addFlash('success', 'Thank your for your message, we`ll connect you later');
            return $this->redirectToRoute('feedback');
        }

        return $this->render('feedback/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
