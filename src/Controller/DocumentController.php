<?php

namespace App\Controller;

use App\Entity\Document;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocumentController extends Controller
{
    /**
     * @Route("/", name="document")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        return $this->render('document/index.html.twig', [
            'documents' => $entityManager->getRepository(Document::class)->findAll(),
        ]);
    }
}
