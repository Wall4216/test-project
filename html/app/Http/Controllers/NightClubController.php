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
    public function index(Request $request)
    {
        $participantCount = $request->input('participant_count', 5);

        $genres = ['R&b', 'Electrohouse', 'Поп-музыка', 'House', 'Electrodance'];
        $danceStyles = ['hip-hop', 'r&b', 'electrodance', 'house', 'pop'];

        $hipHopMovements = [
            new BodyPartMovement('Тело', ['покачивание вперед-назад']),
            new BodyPartMovement('Ноги', ['полуприсяд']),
            new BodyPartMovement('Руки', ['сгибание в локтях']),
            new BodyPartMovement('Голова', ['кивок вперед-назад']),
        ];

        $electroDanceMovements = [
            new BodyPartMovement('Тело', ['покачивание вперед-назад']),
            new BodyPartMovement('Голова', ['минимальное движение']),
            new BodyPartMovement('Руки', ['круговые движения']),
            new BodyPartMovement('Ноги', ['движение в ритме']),
        ];

        $popMusicMovements = [
            new BodyPartMovement('Тело', ['плавные движения']),
            new BodyPartMovement('Руки', ['жестикуляция']),
            new BodyPartMovement('Ноги', ['изящная хореография']),
            new BodyPartMovement('Голова', ['наклон']),
        ];

        $electroHouseMovements = [
            new BodyPartMovement('Тело', ['покачивание вперед-назад']),
            new BodyPartMovement('Голова', ['минимальное движение']),
            new BodyPartMovement('Руки', ['синхронные движения']),
            new BodyPartMovement('Ноги', ['свободное движение']),
        ];

        $houseMovements = [
            new BodyPartMovement('Тело', ['покачивание вперед-назад']),
            new BodyPartMovement('Голова', ['движение в такте']),
            new BodyPartMovement('Руки', ['размахивание']),
            new BodyPartMovement('Ноги', ['синхронные движения']),
        ];

        $nightClub = new NightClub();

        // Генерация случайных участников
        for ($i = 1; $i <= $participantCount; $i++) {
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
            } elseif ($personDanceStyles[0] === 'house') {
                $personMovements[] = $houseMovements;
            } elseif ($personDanceStyles[0] === 'electrohouse') {
                $personMovements[] = $electroHouseMovements;
            }

            if ($personDanceStyles[1] === 'hip-hop') {
                $personMovements[] = $hipHopMovements;
            } elseif ($personDanceStyles[1] === 'electrodance') {
                $personMovements[] = $electroDanceMovements;
            } elseif ($personDanceStyles[1] === 'pop') {
                $personMovements[] = $popMusicMovements;
            } elseif ($personDanceStyles[1] === 'house') {
                $personMovements[] = $houseMovements;
            } elseif ($personDanceStyles[1] === 'electrohouse') {
                $personMovements[] = $electroHouseMovements;
            }

            $person = new Person($name, $personDanceStyles, $personMovements);
            $nightClub->addPerson($person);
        }

        $nightClub->setMusicGenre(new Genre('house')); // Изменение жанра на "R&b"
        $nightClub->startParty();

        // Подготовка JSON-ответа
        $response = [
            'message' => 'Nightclub party started!',
            'music_genre' => $nightClub->getMusicGenre()->getName(),
            'participants' => $nightClub->getPersonActions(),
        ];

        return response()->json($response);
    }

    public function startParty($participant_count)
    {
        return $this->index(new Request(['participant_count' => $participant_count]));
    }
}
