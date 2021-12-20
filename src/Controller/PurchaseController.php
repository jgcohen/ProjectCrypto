<?php

namespace App\Controller;

use App\Entity\Gains;
use App\Entity\Purchase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTimeImmutable;
use App\Form\PurchaseType;
use App\Form\GainType;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\CallApiService;


class PurchaseController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/purchase", name="purchase")
     */
    public function index(Request $request): Response
    {
        
        $purchase =  new Purchase();
        $form = $this->createForm(PurchaseType::class, $purchase);
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
    /**
     * @Route("/purchases", name="purchases")
     */
    public function show(CallApiService $callApiService, Request $request): Response
    {
        // $myDatas = $callApiService->getData()['data'];
        // $name=[];
        // var_dump($this);
        $gain =  new Gains();
        $form = $this->createForm(GainType::class, $gain);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $gain->setUser($this->getUser());
            $gain->setCreatedAt(new DateTimeImmutable());
            $this->entityManager->persist($gain);
            $this->entityManager->flush();
        }
        $purchases = $this->entityManager->getRepository(Purchase::class)->findAll();
//         foreach ( $myDatas as $value ){
//             foreach ($purchases as $purchase){
//                 if($value['name'] == $purchase->getCurrency()){

//                     array_push($name, ((($value['quote']['USD']['price']-$purchase->getPrice())*$purchase->getQuantity())));
//                 }
//             }
//         }
//         $total = 0;
// foreach($name as $val) $total += $val;
//     //    dd($total);
        return $this->render('purchase/show.html.twig', [
            'purchases' => $purchases,
            'data' => $callApiService->getData(),
            'form' => $form->createView()
        ]);
    }
}
