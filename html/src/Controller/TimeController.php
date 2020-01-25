<?php

namespace App\Controller;

use App\Services\Mars\TimeService;
use DateTime;
use DateTimeZone;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->json([
            'message' => 'You should set planet for time calculation',
        ]);
    }

    /**
     * @Route("/mars", name="marsTime")
     * @param TimeService $marsTimeService
     * @param Request     $request
     *
     * @return JsonResponse|Response
     */
    public function marsTime(TimeService $marsTimeService, Request $request)
    {
        try {
            $date = $request->query->get('date');

            if (!$date) {
                $date = 'now';
            }

            $date = new DateTime($date, new DateTimeZone('UTC'));

            $planetTime = $marsTimeService->getTime($date);

            $result = [
                'MSD' => $planetTime->getDays(),
                'MTC' => $planetTime->getFormattedTime(),
            ];

        } catch (Exception $e) {
            return $this->json(['message' => 'Invalid date format'], 400);
        }

        return $this->json($result);
    }
}
