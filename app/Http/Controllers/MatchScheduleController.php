<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;

class MatchScheduleController extends Controller
{
    public function index()
    {
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', env('BASE_URL') . '/schedule');

        $arr = ['name' => 'bayu'];
        $scheduleData = [];



        $tabs = $crawler->filter('.outer-tabs-schedule');
        //buat sendiri
        for ($i = 1; $i <= 8; $i++) {
            //
        }
        $week1 = $tabs->filter('#t-week-1');
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
                            ['teamName1' => $team1_name, 'teamIcon1' => $team1_icon, 'score1' => $team1_score, 'teamName2' => $team2_name, 'teamIcon2' => $team2_icon, 'score2' => $team2_score]

                        ]
                    ];
                }
            );
            return [
                'date' => $date,
                'matches' => $matches,
            ];
        });
        $scheduleData[] = $col;

        return $col;
    }

    public function getMatchesByWeek($week)
    {
        // try {
        //     $matches = array_filter($this->matchSchedule, function ($match) use ($week) {
        //         return strcasecmp($match['week'], $week) === 0;
        //     });

        //     if (empty($matches)) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'No matches found for the specified week',
        //         ], 404);
        //     }

        //     return response()->json([
        //         'success' => true,
        //         'data' => $matches,
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Failed to fetch match schedule',
        //     ], 500);
        // }
    }
}
