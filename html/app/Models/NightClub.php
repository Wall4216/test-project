<?php
// app/Models/NightClub.php

namespace App\Models;

class NightClub
{
    private $musicGenre;
    private $people;

    const DANCE_STYLE_MAPPING = [
        'R&b' => ['hip-hop', 'r&b'],
        'Electrohouse' => ['electrodance', 'house'],
        'Поп-музыка' => ['pop'],
        'House' => ['electrodance', 'house'],
        'Electrodance' => ['electrodance', 'electrohouse'],
    ];

    public function __construct()
    {
        $this->people = [];
    }

    public function setMusicGenre($genre)
    {
        $this->musicGenre = $genre;
    }

    public function addPerson($person)
    {
        $this->people[] = $person;
    }

    public function startParty()
    {
        foreach ($this->people as $person) {
            if ($person->canDanceToGenre($this->musicGenre)) {
                $person->dance();
            } else {
                $person->drink();
            }
        }
    }

    public static function getDanceStylesForGenre($genre)
    {
        return self::DANCE_STYLE_MAPPING[$genre->getName()] ?? [];
    }

    public function getMusicGenre()
    {
        return $this->musicGenre;
    }
}
