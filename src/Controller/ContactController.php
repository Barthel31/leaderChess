<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $message = (new Email())
                ->from($contact['email'])
                ->to('adminChess@wcs.com')
                ->subject('Demande d\'ajout en tant que contributeur')               
                ->html('<p>Bonjour, je voudrais rejoindre votre équipe en tant que contributeur mon pseudo est ' . $contact['pseudo'] . ' est mon adresse mail est ' . $contact['email'] . '. Merci ' . $contact['prenom'] . '</p>');
                $mailer->send($message);
           
            $this->addFlash('succes', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.');
            
            return $this->redirectToRoute('ranking_blitz', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('contact/index.html.twig',['form' => $form->createView()]);
    }
}
