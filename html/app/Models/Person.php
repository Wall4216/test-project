<?php

// app/Models/Person.php

namespace App\Models;

use App\Models\NightClub;

class Person
{
    private $name;
    private $danceStyles;
    private $bodyPartMovements;

    public function __construct($name, $danceStyles, $bodyPartMovements)
    {
        $this->name = $name;
        $this->danceStyles = $danceStyles;
        $this->bodyPartMovements = $bodyPartMovements;
    }

    public function canDanceToGenre($genre)
    {
        $danceStyles = NightClub::getDanceStylesForGenre($genre);
        return !empty($danceStyles);
    }

    public function dance()
    {
        $danceMoves = [];
        foreach ($this->bodyPartMovements as $bodyPartMovement) {
            $bodyPart = $bodyPartMovement->getBodyPart();
            $movements = $bodyPartMovement->getMovements();

            $danceMoves[] = $bodyPart . " движения: " . implode(", ", $movements);
        }

        $danceString = $this->name . " танцует:\n" . implode("\n", $danceMoves);
        return $danceString;
    }

    public function drink()
    {
        echo $this->name . " пьет водку за баром." . PHP_EOL;
    }
}
