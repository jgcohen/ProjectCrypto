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
use Symfony\Contracts\HttpClient\HttpClientInterface;


class PurchaseController extends AbstractController
{
    public function __construct(HttpClientInterface $client, EntityManagerInterface $entityManager)
    {
        $this->client = $client;
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
            $this->addFlash('notice', 'Enregistrement de la crypto effectuée');
        }
        return $this->render('purchase/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function getData(): array
    {
        $response = $this->client->request(
            'GET',
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
            ['headers' => [
                'Accepts: application/json',
                'X-CMC_PRO_API_KEY: 2e36d0ab-fd40-4059-9b49-97ab20b4bc3c'
            ]]
        );
        return $response->toArray();
    }
    /**
     * @Route("/purchases", name="purchases")
     */

    public function show(CallApiService $callApiService, Request $request): Response
    {

        $data = $this->getData()['data'];
        $gains = [];
        $purchases = $this->entityManager->getRepository(Purchase::class)->findAll();
        foreach ($data as $value) {
            foreach ($purchases as $purchase) {
                if ($value['name'] == $purchase->getCurrency()) {

                    array_push($gains, ((($value['quote']['USD']['price'] - $purchase->getPrice()) * $purchase->getQuantity())));
                }
            }
        }
        $total = 0;
        foreach ($gains as $totalGain) $total += $totalGain;

        return $this->render('purchase/show.html.twig', [
            'purchases' => $purchases,
            'data' => $callApiService->getData(),
            'totalGain' => $total
            // 'form' => $form->createView()
        ]);
    }
     /**
     * @Route("/edit/{id}", name="edit")
     */

    public function edit(Request $request,$id): Response
    {
        $purchase = $this->entityManager->getRepository(Purchase::class)->find($id);
        $form = $this->createForm(PurchaseType::class, $purchase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
        }
        return $this->render('purchase/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
     /**
     * @Route("/purchase/{id}", name="single")
     */
    public function single($id): Response
    {
        $purchase = $this->entityManager->getRepository(Purchase::class)->find($id);
        
        return $this->render('purchase/single.html.twig', [
            'purchase' => $purchase,
        ]);
    }
}
