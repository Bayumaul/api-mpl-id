<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

use function Laravel\Prompts\text;
use function PHPUnit\Framework\matches;

class ScraperController extends Controller
{
    public function index()
    {
        $client = new Client();

        $website = $client->request('GET', 'https://id-mpl.com/schedule');
        $filter = '#t-week-4 > div > div:nth-child(1) > div > div.match.position-relative.bb.first.py-2.px-3 > div.d-flex.flex-row.justify-content-between.align-items-center > div.team.team1.d-flex.flex-column.justify-content-center.align-items-center > div.name';
        // return  $website->filter($filter)->each(function ($node) {
        //     dump($node);
        // });
        return  $website->filter($filter)->text();
    }
    public function team()
    {
        $client = new Client();

        $website = $client->request('GET', 'https://id-mpl.com/teams');
        // $filter = '#content > div > div > div > div:nth-child(1) > a > div.team-name';
        // // return  $website->filter($filter)->each(function ($node) {
        // //     dump($node);
        // // });
        $teams = $website->filter('.team-name')->each(function ($node) {
            dump($node->text());
        });
    }

    /**
     * @OA\Get(
     *     path="/api/team/{team}",
     *     summary="Get team details by team name",
     *     tags={"Teams"},
     *     @OA\Parameter(
     *         name="team",
     *         in="path",
     *         required=true,
     *         description="Team name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Team details retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="country", type="string"),
     *             @OA\Property(property="players", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="position", type="string")
     *             ))
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Team not found"
     *     )
     * )
     */
    public function getTeamDetails($team)
    {
        $client = new Client();

        $website = $client->request('GET', 'https://id-mpl.com/team/' . $team);
        $teamName = $website->filter('div.team-name > h2')->text();
        $teamIcon = $website->filter('div.team-logo > img')->attr('src');
        $aboutTeam = $website->filter('#about-team > div.main-lates-matches')->text();
        $roster_sesaon = $website->filter('div.team-players > .ornament-team > h4')->text();
        $season = str_replace('Roster Season ', '', $roster_sesaon);
        $rosters = $website->filter('div.team-players > .row > div')->each(function ($roster) {
            $name = $roster->filter('.player-name')->text();
            $image = $roster->filter('.player-image-bg > img')->attr('src');
            $url = $roster->filter('a')->attr('href');

            return [
                'name' => $name,
                'image' => $image,
                'url' => $url,
            ];
        });
        $matches = $website->filter('.match-team')->each(function ($match) {
            $week = $match->filter('.match-detail > .row > div > div:nth-child(1)')->text();
            $dateAndTime = $match->filter('.match-detail > .row > div > div:nth-child(2)')->text();
            $status = $match->filter('.match-status-wl')->text();
            $score = $match->filter('.match-score-team > .score')->text();
            $teams = $match->filter('.match-logo')->each(function ($team) {
                $teamName = $team->text();
                $teamIcon = $team->filter('img')->attr('src');

                return [
                    'teamName' => $teamName,
                    'teamIcon' => $teamIcon,
                ];
            });
            return [
                'week' => $week,
                'dateAndTime' => $dateAndTime,
                'status' => $status,
                'score' => $score,
                'teams' => $teams,
            ];
        });

        $result = [
            'name' => $teamName,
            'icon' => $teamIcon,
            'about' => $aboutTeam,
            'season' => $season,
            'roster' => $rosters,
            'matches' => $matches,
        ];

        return $this->sendResponse($result, 200);
    }
}
