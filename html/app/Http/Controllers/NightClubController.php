<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Genre;
use App\Models\BodyPartMovement;
use App\Models\NightClub;

class NightClubController extends Controller
{
    public function index()
    {
        $danceStyles = [
            'hip-hop' => ['body swaying', 'knee bends', 'arm swings', 'head bobs'],
            'r&b' => ['groovy body movements', 'smooth footwork', 'hand gestures'],
            'electrodance' => ['body rocking', 'minimal head movement', 'arm circles', 'leg movements'],
            'house' => ['synchronized footwork', 'fast arm movements', 'groove steps'],
            'pop' => ['smooth body movements', 'hand gestures', 'graceful footwork', 'head tilts'],
        ];

        $people = [];

        for ($i = 1; $i <= 3; $i++) {
            $name = 'Person ' . $i;
            $randomDanceStyles = array_rand($danceStyles, rand(1, count($danceStyles)));
            $bodyPartMovements = [];

            foreach ($randomDanceStyles as $danceStyle) {
                $movements = $danceStyles[$danceStyle];
                $bodyPart = ucwords(str_replace('-', ' ', $danceStyle));
                $bodyPartMovements[] = new BodyPartMovement($bodyPart, $movements);
            }

            $person = new Person($name, $randomDanceStyles, $bodyPartMovements);
            $people[] = $person;
        }

        $nightClub = new NightClub();
        $nightClub->setMusicGenre(new Genre('R&b'));

        foreach ($people as $person) {
            $nightClub->addPerson($person);
        }

        $nightClub->startParty();

        return response()->json(['message' => 'Nightclub party started!']);
    }
}
