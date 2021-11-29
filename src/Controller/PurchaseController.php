<?php

namespace App\Controller;

use App\Entity\Purchase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTimeImmutable;
use App\Form\PurchaseType;
use Doctrine\ORM\EntityManagerInterface;


class PurchaseController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/purchase", name="purchase")
     */
    public function index( Request $request): Response
    {
        $purchase =  new Purchase();
        $form = $this->createForm(PurchaseType::class,$purchase);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $purchase->setUser($this->getUser());
            $purchase->setCreatedAt(new DateTimeImmutable());
            $this->entityManager->persist($purchase);
            $this->entityManager->flush();
        }
        return $this->render('purchase/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
