<?php

namespace App\Controller;

use App\Entity\Gains;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class GraphController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/graph", name="graph")
     */
    public function index(ChartBuilderInterface $chartBuilder): Response
    {
        $values = [];
        $dates = [];
        $gains =  $this->entityManager->getRepository(Gains::class)->findAll();
        foreach ($gains as $gain) {
            array_push($values, ($gain->getValue()));
            array_push($dates, ($gain->getCreatedAt()));
        }
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Mes gains',
                    'borderColor' => 'rgb(31, 195, 108)',
                    'data' => $values,
                ],
            ],

        ]);
        $chart->setOptions([
            'scales' => ['x' => ['display' => false]],
            'legend' => [
                'display' => false
            ]
        ]);
        return $this->render('graph/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
