<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\DocumentStatus;
use App\Entity\DocumentType;
use App\Entity\Reimbursement;
use App\Form\DocumentFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("document/create/{id}", name="document_create", requirements={"id"="\d+"})
     * @ParamConverter("documentType", class="App\Entity\DocumentType")
     *
     * @param Request $request
     * @param DocumentType $documentType
     * @return Response
     */
    public function create(Request $request, DocumentType $documentType)
    {
        $em = $this->getDoctrine()->getManager();

        $document = new Document();
        $document->setStatus($em->getRepository(DocumentStatus::class)->find(DocumentStatus::STATUS_NEW));
        $document->setType($documentType);
        if ($document->isReimbursement()) {
            $document->addReimbursement(new Reimbursement());
        }

        $form = $this->createForm(DocumentFormType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $document = $form->getData();
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('document_show');
        }

        return $this->render('document/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("document/edit/{id}", name="document_edit", requirements={"id"="\d+"})
     * @ParamConverter("document", class="App\Entity\Document")
     *
     * @param Request $request
     * @param Document $document
     * @return Response
     */
    public function edit(Request $request, Document $document)
    {
        $form = $this->createForm(DocumentFormType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $document = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('document_show', ['id' => $document->getId()]);
        }

        return $this->render('document/edit.html.twig', [
            'document' => $document,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("document/addReimbursement/{id}", name="document_add_reimbursement", requirements={"id"="\d+"})
     * @ParamConverter("document", class="App\Entity\Document")
     *
     * @param Request $request
     * @param Document $document
     * @return Response
     */
    public function addReimbursement(Request $request, Document $document)
    {
        $document->addReimbursement(new Reimbursement());
        return $this->edit($request, $document);
    }
}
