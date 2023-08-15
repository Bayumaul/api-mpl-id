<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;

class MatchScheduleController extends Controller
{
    /**
     * @OA\Get(
     *      path="/match-schedule",
     *      operationId="getMatchSchedule",
     *      tags={"Match Schedule"},
     *      summary="Get match schedule",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/MatchSchedule")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Failed to fetch match schedule",
     *      )
     * )
     *
     * @OA\Get(
     *      path="/match-schedule/{week}",
     *      operationId="getMatchScheduleByWeek",
     *      tags={"Match Schedule"},
     *      summary="Get match schedule for a specific week",
     *      @OA\Parameter(
     *          name="week",
     *          in="path",
     *          required=true,
     *          description="Week number",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="week", type="integer"),
     *              @OA\Property(property="schedule", type="array", @OA\Items(ref="#/components/schemas/ScheduleWeek")),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Match schedule not found",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Failed to fetch match schedule",
     *      )
     * )
     *
     * @OA\Schema(
     *      schema="TeamInfo",
     *      @OA\Property(property="teamName", type="string"),
     *      @OA\Property(property="teamIcon", type="string"),
     *      @OA\Property(property="score", type="string"),
     * )
     *
     * @OA\Schema(
     *      schema="Match",
     *      @OA\Property(property="time", type="string"),
     *      @OA\Property(property="teams", type="object",
     *          @OA\Property(property="teamName1", type="string"),
     *          @OA\Property(property="teamIcon1", type="string"),
     *          @OA\Property(property="score1", type="string"),
     *          @OA\Property(property="teamName2", type="string"),
     *          @OA\Property(property="teamIcon2", type="string"),
     *          @OA\Property(property="score2", type="string"),
     *      ),
     * )
     *
     * @OA\Schema(
     *      schema="ScheduleWeek",
     *      @OA\Property(property="date", type="array", @OA\Items(type="string")),
     *      @OA\Property(property="matches", type="array", @OA\Items(ref="#/components/schemas/Match")),
     * )
     *
     * @OA\Schema(
     *      schema="MatchSchedule",
     *      @OA\Property(property="week", type="integer"),
     *      @OA\Property(property="schedule", type="array", @OA\Items(ref="#/components/schemas/ScheduleWeek")),
     * )
     */


    public function index()
    {
        try {
            $client = new Client(HttpClient::create(['timeout' => 60]));
            $crawler = $client->request('GET', env('BASE_URL') . '/schedule');

            $result = [];

            $tabs = $crawler->filter('.outer-tabs-schedule');
            for ($i = 1; $i <= 8; $i++) {
                $schedule = [];
                $week1 = $tabs->filter('#t-week-' . $i);
                $col = $week1->filter('.col-lg-5')->each(function ($column) {
                    $date = $column->filter('.match.date')->each(
                        function ($match) {
                            return $match->filter('.match.date')->text();
                        }
                    );
                    $matches = $column->filter('.match.position-relative')->each(
                        function ($match) {
                            $time = $match->filter('.pt-1')->text();
                            $team1 = $match->filter('.team1');
                            $team1_name = $team1->filter('.name')->text();
                            $team1_icon = $team1->filter('img')->attr('src');
                            $team1_score = $match->filter('.score.font-primary')->eq(0)->text();
                            $team2 = $match->filter('.team2');
                            $team2_name = $team2->filter('.name')->text();
                            $team2_icon = $team2->filter('img')->attr('src');
                            $team2_score = $match->filter('.score.font-primary')->eq(1)->text();
                            return [
                                'match' => [
                                    'time' => $time,
                                    'teams' =>
                                    [
                                        'teamName1' => $team1_name,
                                        'teamIcon1' => $team1_icon,
                                        'score1' => $team1_score,
                                        'teamName2' => $team2_name,
                                        'teamIcon2' => $team2_icon,
                                        'score2' => $team2_score
                                    ]

                                ]
                            ];
                        }
                    );
                    return [
                        'date' => $date,
                        'matches' => $matches,
                    ];
                });
                $schedule = [
                    'week' => $i,
                    'schedule' => $col,
                ];
                $result[] = $schedule;
            }
            return $this->sendResponse($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch match schedule',
            ], 500);
        }
    }

    public function getMatchesByWeek($week)
    {
        if (strlen($week) != 1) {
            return response()->json([
                'success' => false,
                'message' => 'Match schedule not found',
            ], 404);
        }
        try {
            $client = new Client(HttpClient::create(['timeout' => 60]));
            $crawler = $client->request('GET', env('BASE_URL') . '/schedule');

            $result = [];

            $tabs = $crawler->filter('.outer-tabs-schedule');
            $schedule = [];
            $week1 = $tabs->filter('#t-week-' . $week);
            $col = $week1->filter('.col-lg-5')->each(function ($column) {
                $date = $column->filter('.match.date')->each(
                    function ($match) {
                        return $match->filter('.match.date')->text();
                    }
                );
                $matches = $column->filter('.match.position-relative')->each(
                    function ($match) {
                        $time = $match->filter('.pt-1')->text();
                        $team1 = $match->filter('.team1');
                        $team1_name = $team1->filter('.name')->text();
                        $team1_icon = $team1->filter('img')->attr('src');
                        $team1_score = $match->filter('.score.font-primary')->eq(0)->text();
                        $team2 = $match->filter('.team2');
                        $team2_name = $team2->filter('.name')->text();
                        $team2_icon = $team2->filter('img')->attr('src');
                        $team2_score = $match->filter('.score.font-primary')->eq(1)->text();
                        return [
                            'match' => [
                                'time' => $time,
                                'teams' =>
                                [
                                    'teamName1' => $team1_name,
                                    'teamIcon1' => $team1_icon,
                                    'score1' => $team1_score,
                                    'teamName2' => $team2_name,
                                    'teamIcon2' => $team2_icon,
                                    'score2' => $team2_score
                                ]

                            ]
                        ];
                    }
                );
                return [
                    'date' => $date,
                    'matches' => $matches,
                ];
            });
            $result = [
                'week' => $week,
                'schedule' => $col,
            ];
            return $this->sendResponse($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch match schedule',
            ], 500);
        }
    }
}
