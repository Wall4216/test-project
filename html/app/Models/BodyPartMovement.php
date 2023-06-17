<?php

// app/Models/BodyPartMovement.php

namespace App\Models;

class BodyPartMovement
{
    const MOVEMENTS = [
        'body swaying', 'knee bends', 'arm swings', 'head bobs', 'body rocking',
        'minimal head movement', 'arm circles', 'leg movements', 'smooth body movements',
        'hand gestures', 'graceful footwork', 'head tilts'
    ];

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

