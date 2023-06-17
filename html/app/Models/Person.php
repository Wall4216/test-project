<?php

namespace App\Models;

use App\Models\NightClub;

class Person
{
    private $name;
    private $danceStyles;
    private $bodyPartMovements;
    private $nightClub;

    public function __construct($name, $danceStyles, $bodyPartMovements)
    {
        $this->name = $name;
        $this->danceStyles = $danceStyles;
        $this->bodyPartMovements = $bodyPartMovements;
    }

    public function setNightClub(NightClub $nightClub)
    {
        $this->nightClub = $nightClub;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getActions()
    {
        $actions = [];

        if ($this->nightClub) {
            $genre = $this->nightClub->getMusicGenre();

            if ($this->canDanceToGenre($genre)) {
                $actions[] = $this->dance();
            }
        }

        if (empty($actions)) {
            $actions[] = $this->drink();
        }

        return $actions;
    }

    public function canDanceToGenre($genre)
    {
        $danceStyles = NightClub::getDanceStylesForGenre($genre);
        return in_array($this->danceStyles[0], $danceStyles);
    }


    public function dance()
    {
        $danceMoves = [];
        foreach ($this->bodyPartMovements as $bodyPartMovements) {
            foreach ($bodyPartMovements as $bodyPartMovement) {
                $bodyPart = $bodyPartMovement->getBodyPart();
                $movements = $bodyPartMovement->getMovements();

                $danceMoves[] = $bodyPart . " movements: " . implode(", ", $movements);
            }
        }

        $danceString = $this->name . " is dancing:\n" . implode("\n", $danceMoves);
        return $danceString;
    }

    public function drink()
    {
        return $this->name . " is drinking at the bar.";
    }
}
