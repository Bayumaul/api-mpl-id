<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

use function Laravel\Prompts\text;

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
    public function getTeam($team)
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
        // $matchs = $website->filter('match-team')->each(function ($match) {
        //     $name = $roster->filter('.player-name')->text();

        //     return [
        //         'name' => $name,
        //     ];
        // });

        return [
            'name' => $teamName,
            'icon' => $teamIcon,
            'about' => $aboutTeam,
            'season' => $season,
            'roster' => $rosters,
            // 'match' => $matchs,
        ];
    }
}
