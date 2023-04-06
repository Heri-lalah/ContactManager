<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contacts', name: 'contacts')]
    public function index(ContactRepository $contactRepository): Response
    {
        $contacts = $contactRepository->getRandomContact();

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts
        ]);
    }

    #[Route('/contact/{id}', name:'show_contact')]
    public function show(int $id, ContactRepository $contactRepository)
    {
        $contacts = $contactRepository->getRandomContact();
        $contact = $contactRepository->find($id);

        if(!$contact) {
            throw$this->createNotFoundException("Produit introuvable");
        }

        return $this->render('contact/showContact.html.twig',
            [
                'contact' => $contact,
                'contacts' => $contacts
            ]);
    }
}
