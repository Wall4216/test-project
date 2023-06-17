<?php

// app/Http/Controllers/NightClubController.php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Genre;
use App\Models\BodyPartMovement;
use App\Models\NightClub;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NightClubController extends Controller
{
    public function index()
    {
        $genres = ['hip-hop', 'electrodance', 'pop']; // Жанры музыки

        $nightClub = new NightClub();

        // Создание случайных участников
        $person1 = $this->createRandomPerson('John', $genres);
        $person2 = $this->createRandomPerson('Jane', $genres);
        $person3 = $this->createRandomPerson('Alice', $genres);

        $nightClub->setMusicGenre(new Genre('R&b'));
        $nightClub->addPerson($person1);
        $nightClub->addPerson($person2);
        $nightClub->addPerson($person3);

        $nightClub->startParty();

        return response()->json(['message' => 'Nightclub party started!']);
    }

    public function setPeopleCount(Request $request)
    {
        $count = $request->input('count');
        $nightClub = NightClub::first(); // Получаем существующий объект клуба из базы данных
        if ($nightClub) {
            $nightClub->setPeopleCount($count);
            $nightClub->startParty();
            $nightClub->save(); // Сохранить количество людей в базе данных
            return response()->json(['message' => 'Nightclub party started with ' . $count . ' people!']);
        } else {
            return response()->json(['message' => 'Nightclub not found!'], 404);
        }
    }



    private function createRandomPerson($name, $genres)
    {
        $danceStyles = []; // Случайные стили танца
        $bodyPartMovements = []; // Случайные движения частей тела

        // Генерация случайных стилей танца
        $numStyles = rand(1, count($genres));
        $randomGenres = array_rand($genres, $numStyles);
        foreach ($randomGenres as $genreIndex) {
            $danceStyles[] = $genres[$genreIndex];
        }

        // Генерация случайных движений частей тела
        $bodyParts = ['head', 'arms', 'legs', 'torso'];
        foreach ($bodyParts as $bodyPart) {
            $numMovements = rand(1, 4); // От 1 до 4 движений для каждой части тела
            $randomMovements = array_rand(BodyPartMovement::MOVEMENTS, $numMovements);
            $movements = [];
            foreach ($randomMovements as $movementIndex) {
                $movements[] = BodyPartMovement::MOVEMENTS[$movementIndex];
            }
            $bodyPartMovements[$bodyPart] = $movements;
        }

        return new Person($name, $danceStyles, $bodyPartMovements);
    }
}

