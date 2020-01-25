<?php

namespace App\Controller;

use App\Exceptions\InvalidDateException;
use App\Services\Mars\TimeService;
use DateTime;
use DateTimeZone;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
                'MTC' => $planetTime->getFormattedTime()
            ];

        } catch (Exception $e) {
            throw new InvalidDateException('Invalid date format');
        }

        return $this->json($result);
    }
}
