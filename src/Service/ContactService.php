<?php


namespace App\Service;


use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

class ContactService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function NewContactSubmit(Contact $c, $ip = null)
    {
        //ajout des champs cachés
        $c->setIp($ip);
        $c->setCreatedAt(new \DateTime());
        $c->setUpdatedAt(new \DateTime());

        $this->em->persist($c);
        $this->em->flush();
    }
}