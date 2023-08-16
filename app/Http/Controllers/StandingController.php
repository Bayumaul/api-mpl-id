<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

use function Laravel\Prompts\text;

class StandingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/get-standings",
     *     summary="Get standings data",
     *     tags={"Standings"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response with standings data",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="teamRank", type="string", example="1"),
     *                 @OA\Property(property="teamName", type="string", example="ONIC"),
     *                 @OA\Property(property="matchWL", type="string", example="6 - 2"),
     *                 @OA\Property(property="matchRate", type="string", example="75%"),
     *                 @OA\Property(property="gameWL", type="string", example="13 - 5"),
     *                 @OA\Property(property="gameRate", type="string", example="72%"),
     *                 @OA\Property(property="aggPoints", type="string", example="+8"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error response in case of failure",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An error occurred while fetching standings."),
     *         ),
     *     ),
     * )
     */
    public function getStandings()
    {
        try {
            $client = new Client(HttpClient::create(['timeout' => 60]));
            $crawler = $client->request('GET', 'https://id-mpl.com/');

            $result = $crawler->filter('.table tbody tr')->each(function ($row) {
                $teamRank = $row->filter('.team-rank')->text();
                $teamName = $row->filter('.team-name')->text();
                $matchWL = $row->filter('td')->eq(1)->text();
                $matchRate = $row->filter('td')->eq(2)->text();
                $gameWL = $row->filter('td')->eq(3)->text();
                $gameRate = $row->filter('td')->eq(4)->text();
                $aggPoints = $row->filter('td')->eq(5)->text();

                return [
                    'teamRank' => $teamRank,
                    'teamName' => $teamName,
                    'matchWL' => $matchWL,
                    'matchRate' => $matchRate,
                    'gameWL' => $gameWL,
                    'gameRate' => $gameRate,
                    'aggPoints' => $aggPoints,
                ];
            });

            return $this->sendResponse($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching standings.',
            ], 500);
        }
    }
}
