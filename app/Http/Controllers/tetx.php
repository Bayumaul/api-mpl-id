use Goutte\Client;

$html = <<<HTML # Tempelkan HTML di sini HTML; $client=new Client(); $crawler=$client->request('GET', 'http://example.com'); // Ganti dengan URL yang sesuai

    $scheduleData = [];

    $tabs = $crawler->filter('.outer-tabs-schedule');
    $tabs->each(function ($tab) use (&$scheduleData) {
    $tab->filter('.match.position-relative')->each(function ($match) use (&$scheduleData) {
    $date = $match->filter('.match.date')->text();
    $time = $match->filter('.pt-1')->text();

    $team1 = $match->filter('.team1');
    $team1_name = $team1->filter('.name')->text();
    $team1_icon = $team1->filter('img')->attr('src');
    $team1_score = $match->filter('.score.font-primary')->eq(0)->text();

    $team2 = $match->filter('.team2');
    $team2_name = $team2->filter('.name')->text();
    $team2_icon = $team2->filter('img')->attr('src');
    $team2_score = $match->filter('.score.font-primary')->eq(1)->text();

    $matchData = [
    'tanggal' => $date,
    'match' => [
    'waktu' => $time,
    'team' => [
    ['teamName' => $team1_name, 'teamIcon' => $team1_icon, 'score' => $team1_score],
    ['teamName' => $team2_name, 'teamIcon' => $team2_icon, 'score' => $team2_score]
    ]
    ]
    ];

    $scheduleData[] = $matchData;
    });
    });

    // Print hasil scraping sesuai dengan format yang diinginkan
    foreach ($scheduleData as $match) {
    echo 'Tanggal: ' . $match['tanggal'] . "\n";
    echo 'Match:' . "\n";
    foreach ($match['match']['team'] as $team) {
    echo ' Waktu: ' . $match['match']['waktu'] . "\n";
    echo ' Team Name: ' . $team['teamName'] . "\n";
    echo ' Team Icon: ' . $team['teamIcon'] . "\n";
    echo ' Score: ' . $team['score'] . "\n";
    }
    echo "\n";
    }