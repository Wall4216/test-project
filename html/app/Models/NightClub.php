<?php

namespace App\Models;

use App\Models\Person;
use App\Models\Genre;

class NightClub
{
    private $musicGenre;
    private $participants = [];

    public function setMusicGenre(Genre $genre)
    {
        $this->musicGenre = $genre;
    }

    public function addPerson(Person $person)
    {
        $this->participants[] = $person;
    }

    public function startParty()
    {
        // Ваша логика для начала вечеринки

        // Проверяем, есть ли у персонажей стиль танца под текущий жанр
        foreach ($this->participants as $participant) {
            if ($participant->canDanceToGenre($this->musicGenre)) {
                $participant->setNightClub($this);
                $participant->dance(); // Вызываем метод dance() у персонажей, которые умеют танцевать
            } else {
                $participant->drink(); // Вызываем метод drink() у персонажей, которые не умеют танцевать
            }
        }
    }

    public function getMusicGenre()
    {
        return $this->musicGenre;
    }

    public function getPersonActions()
    {
        $actions = [];

        foreach ($this->participants as $participant) {
            $actions[] = [
                'person' => $participant->getName(),
                'actions' => $participant->getActions(),
            ];
        }

        return $actions;
    }

    public static function getDanceStylesForGenre(Genre $genre)
    {
        $genreName = strtolower($genre->getName());

        switch ($genreName) {
            case 'r&b':
                return ['hip-hop', 'r&b'];
            case 'electrodance':
                return ['electrodance'];
            case 'поп-музыка':
                return ['pop'];
            case 'house':
                return ['house'];
            case 'electrohouse':
                return ['electrohouse'];
            default:
                return [];
        }
    }
}
