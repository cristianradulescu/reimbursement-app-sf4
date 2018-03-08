<?php

namespace App\Controller;

use App\Entity\Document;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocumentController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {

        return $this->redirectToRoute('document_list');
    }

    /**
     * @Route("document/list", name="document_list")
     * @return Response
     */
    public function list()
    {
        $entityManager = $this->getDoctrine()->getManager();

        return $this->render('document/list.html.twig', [
            'documents' => $entityManager->getRepository(Document::class)->findAll(),
        ]);
    }

    /**
     * @Route("document/{id}", name="document_show", requirements={"id"="\d+"})
     * @ParamConverter("document", class="App\Entity\Document")
     *
     * @param Document $document
     * @return Response
     */
    public function show(Document $document)
    {
        return $this->render('document/show.html.twig', [
            'document' => $document
        ]);
    }
}
