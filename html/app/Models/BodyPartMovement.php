<?php

// app/Models/BodyPartMovement.php

namespace App\Models;

class BodyPartMovement
{
    private $bodyPart;
    private $movements;

    public function __construct($bodyPart, $movements)
    {
        $this->bodyPart = $bodyPart;
        $this->movements = $movements;
    }

    public function getBodyPart()
    {
        return $this->bodyPart;
    }

    public function getMovements()
    {
        return $this->movements;
    }
}
