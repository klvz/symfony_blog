<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/contact")
     */
    public function contact(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //todo : Enregistrement de la demande de contact en BDD
            //$mailer->sendMail($form->getData());

            $this->addFlash('success', 'Merci pour votre message. Je reviendrai vers vous rapidement');

            return $this->redirectToRoute('app_default_index');
        }

        return $this->render('default/contact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}
