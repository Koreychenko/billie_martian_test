<?php

namespace App\Controller;

use App\Services\ITimeService;
use App\Services\TimeServiceFactory;
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
     * @Route("/{planetName}", name="marsTime")
     * @param string             $planetName
     * @param TimeServiceFactory $timeServiceFactory
     * @param Request            $request
     *
     * @return JsonResponse|Response
     */
    public function planetTime(string $planetName, TimeServiceFactory $timeServiceFactory, Request $request)
    {
        try {
            $timeService = $timeServiceFactory->getTimeService($planetName);
        } catch (\Exception $exception) {
            return $this->json(['message' => sprintf("We have no time service for planet %s yet", ucfirst($planetName))], 400);
        }

        try {
            $date = $request->query->get('date');

            if (!$date) {
                $date = 'now';
            }

            $date = new DateTime($date, new DateTimeZone('UTC'));

            $planetTime = $timeService->getTime($date);

            $result = [
                'date' => $planetTime->getFormattedDays(),
                'time' => $planetTime->getFormattedTime(),
            ];

        } catch (Exception $e) {
            return $this->json(['message' => 'Invalid date format'], 400);
        }

        return $this->json($result);
    }
}
