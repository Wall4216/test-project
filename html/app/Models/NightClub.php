<?php

// app/Models/NightClub.php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class NightClub extends Model
{
    protected $table = 'night_club';
    protected $fillable = ['music_genre', 'people_count'];
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
                echo $person->dance() . "\n";
            } else {
                $person->drink();
            }
        }
    }

    public static function getDanceStylesForGenre($genre)
    {
        return self::DANCE_STYLE_MAPPING[$genre->getName()] ?? [];
    }
    public function setPeopleCount(Request $request, NightClub $nightClub)
    {
        $count = $request->input('count');
        $nightClub->setPeopleCount($count);
        $nightClub->startParty();
        return response()->json(['message' => 'Nightclub party started with ' . $count . ' people!']);
    }


}
