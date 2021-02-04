<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @param RealisationRepository $realisationRepository
     * @param MailerInterface $mailer
     * @return Response
     */
    public function index(
        Request $request,
        RealisationRepository $realisationRepository,
        MailerInterface $mailer
    ): Response {
        $realisations = $realisationRepository->findAll();

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('aurelie.frarin@gmail.com')
                ->subject('Nouveau message !')
                ->html($this->renderView('newMessageEmail.html.twig', ['contact' => $contact]));
            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé');

            return $this->redirectToRoute('home', [
                '_fragment' => 'contact-section',
                'realisations' => $realisations,
                'form' => $form->createView()
            ]);
        }

        return $this->render('home.html.twig', [
            'realisations' => $realisations,
            'form' => $form->createView()
        ]);
    }
}