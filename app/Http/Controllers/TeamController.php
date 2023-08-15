<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class TeamController extends Controller
{
    /**
     * @OA\Get(
     *     path="/teams",
     *     operationId="getTeams",
     *     tags={"Teams"},
     *     summary="Get a list of teams",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="nameteam", type="string"),
     *                 @OA\Property(property="logoteam", type="string"),
     *                 @OA\Property(property="url", type="string"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An error occurred while fetching teams."),
     *         ),
     *     ),
     * )
     */

    public function getTeams()
    {
        try {
            $client = new Client();

            $crawler = $client->request('GET', 'https://id-mpl.com/teams');

            $result = $crawler->filter('.team-card-outer')->each(function ($node) {
                $name = $node->filter('.team-name')->text();
                $logo = $node->filter('.team-image img')->attr('src');
                $url = $node->filter('a')->attr('href');

                return [
                    'nameteam' => $name,
                    'logoteam' => $logo,
                    'url' => $url,
                ];
            });

            return $this->sendResponse($result, 200);
        } catch (\Exception $e) {
            // Handle the exception here
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching teams.',
            ], 500);
        }
    }
    /**
     * @OA\Get(
     *     path="/team/{team}",
     *     operationId="getTeamDetails",
     *     tags={"Teams"},
     *     summary="Get details of a specific team",
     *     @OA\Parameter(
     *         name="team",
     *         in="path",
     *         required=true,
     *         description="Team name",
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="icon", type="string"),
     *             @OA\Property(property="about", type="string"),
     *             @OA\Property(property="season", type="string"),
     *             @OA\Property(property="roster", type="array", @OA\Items(
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="image", type="string"),
     *                 @OA\Property(property="url", type="string"),
     *             )),
     *             @OA\Property(property="matches", type="array", @OA\Items(
     *                 @OA\Property(property="week", type="string"),
     *                 @OA\Property(property="dateAndTime", type="string"),
     *                 @OA\Property(property="status", type="string"),
     *                 @OA\Property(property="score", type="string"),
     *                 @OA\Property(property="teams", type="array", @OA\Items(
     *                     @OA\Property(property="teamName", type="string"),
     *                     @OA\Property(property="teamIcon", type="string"),
     *                 )),
     *             )),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An error occurred while fetching team information."),
     *         ),
     *     ),
     * )
     */
    public function getTeamDetails($team)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching team information.',
            ], 500);
        }
    }
}
