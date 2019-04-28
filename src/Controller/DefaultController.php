<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\ContactService;
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
    public function contact(Request $request, ContactService $cs)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Enregistrement de la demande de contact en BDD
            $cs->NewContactSubmit($form->getData(),$request->getClientIp());


            //$mailer->sendMail($form->getData());

            $this->addFlash('success', 'Merci pour votre message. Je reviendrai vers vous rapidement');
        }

        return $this->render('default/contact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}
