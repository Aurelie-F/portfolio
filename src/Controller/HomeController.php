<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Realisation;
use App\Form\ContactType;
use App\Repository\RealisationRepository;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @param RealisationRepository $realisationRepository
     * @param SkillsRepository $skillsRepository
     * @param MailerInterface $mailer
     * @return JsonResponse|RedirectResponse|Response
     * @throws TransportExceptionInterface
     */
    public function index(
        Request $request,
        RealisationRepository $realisationRepository,
        SkillsRepository $skillsRepository,
        MailerInterface $mailer
    ) {
        $realisations = $realisationRepository->findAll();
        $skills = $skillsRepository->findAll();

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
                'skills' => $skills,
                'form' => $form->createView()
            ]);
        }

        $filters = $request->get("skills");
        $realisationsFiltered = $realisationRepository->findByFilter($filters);

        if($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('home/_realisations.html.twig', [
                    'realisations' => $realisationsFiltered
                ])
            ]);
        } else {
            return $this->render('home/home.html.twig', [
                'realisations' => $realisations,
                'skills' => $skills,
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/realisations/{id}", name="realisations", methods={"GET"})
     * @param Realisation $realisation
     * @return Response
     */
    public function show(Realisation $realisation): Response
    {
        return $this->render('home/realisation.html.twig', [
            'realisation' => $realisation,
        ]);
    }
}