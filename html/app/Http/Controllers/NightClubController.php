<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Genre;
use App\Models\BodyPartMovement;
use App\Models\NightClub;
use Illuminate\Routing\Controller;

class NightClubController extends Controller
{
    public function index()
    {
        $genres = ['R&b', 'Electrohouse', 'Поп-музыка', 'House', 'Electrodance'];
        $danceStyles = ['hip-hop', 'r&b', 'electrodance', 'house', 'pop'];

        $hipHopMovements = [
            new BodyPartMovement('Body', ['sway forward-backward']),
            new BodyPartMovement('Legs', ['half-squat']),
            new BodyPartMovement('Arms', ['bend at elbows']),
            new BodyPartMovement('Head', ['nod forward-backward']),
        ];

        $electroDanceMovements = [
            new BodyPartMovement('Body', ['rock forward-backward']),
            new BodyPartMovement('Head', ['minimal movement']),
            new BodyPartMovement('Arms', ['circular motions']),
            new BodyPartMovement('Legs', ['move to the rhythm']),
        ];

        $popMusicMovements = [
            new BodyPartMovement('Body', ['smooth movements']),
            new BodyPartMovement('Arms', ['hand gestures']),
            new BodyPartMovement('Legs', ['graceful footwork']),
            new BodyPartMovement('Head', ['tilt']),
        ];

        $nightClub = new NightClub();

        // Генерация случайных участников
        for ($i = 1; $i <= 5; $i++) {
            $name = 'Person ' . $i;
            $randomGenres = array_rand($genres, 2);
            $randomDanceStyles = array_rand($danceStyles, 2);

            $personGenres = [$genres[$randomGenres[0]], $genres[$randomGenres[1]]];
            $personDanceStyles = [$danceStyles[$randomDanceStyles[0]], $danceStyles[$randomDanceStyles[1]]];

            $personMovements = [];
            if ($personDanceStyles[0] === 'hip-hop') {
                $personMovements[] = $hipHopMovements;
            } elseif ($personDanceStyles[0] === 'electrodance') {
                $personMovements[] = $electroDanceMovements;
            } elseif ($personDanceStyles[0] === 'pop') {
                $personMovements[] = $popMusicMovements;
            }

            if ($personDanceStyles[1] === 'hip-hop') {
                $personMovements[] = $hipHopMovements;
            } elseif ($personDanceStyles[1] === 'electrodance') {
                $personMovements[] = $electroDanceMovements;
            } elseif ($personDanceStyles[1] === 'pop') {
                $personMovements[] = $popMusicMovements;
            }

            $person = new Person($name, $personDanceStyles, $personMovements);
            $nightClub->addPerson($person);
        }

        $nightClub->setMusicGenre(new Genre('electrodance')); // Изменение жанра на "R&b"
        $nightClub->startParty();

        // Подготовка JSON-ответа
        $response = [
            'message' => 'Nightclub party started!',
            'music_genre' => $nightClub->getMusicGenre()->getName(),
            'participants' => $nightClub->getPersonActions(),
        ];

        return response()->json($response);
    }
}
