Задачи проекта:

    Определение стилей танца, связанных с различными жанрами музыки.
    Создание модели Person для представления человека, умеющего танцевать.
    Реализация метода canDanceToGenre() в классе Person, чтобы определить, может ли человек танцевать под определенный жанр музыки.
    Создание модели NightClub для представления ночного клуба.
    Реализация метода startParty() в классе NightClub, который проходит по списку людей и определяет, можно ли им танцевать под текущий жанр музыки, и вызывает соответствующие методы dance() или drink().
    Создание модели BodyPartMovement для представления движений частей тела в танце.
    Реализация метода getDanceStylesForGenre() в классе NightClub, который возвращает стили танца для заданного жанра музыки.

Схема решения:

    Создать модель BodyPartMovement, которая содержит информацию о движениях частей тела в танце.
    Создать модель Genre, которая представляет жанр музыки.
    Создать модель Person, которая содержит информацию о человеке, его имене, стилях танца и движениях частей тела.
    Реализовать метод canDanceToGenre() в классе Person, который проверяет, может ли человек танцевать под определенный жанр музыки.
    Создать модель NightClub, которая представляет ночной клуб и содержит информацию о текущем жанре музыки и людях, присутствующих в клубе.
    Реализовать метод startParty() в классе NightClub, который перебирает список людей в клубе и определяет, может ли каждый из них танцевать под текущий жанр музыки. Если да, вызывается метод dance(), иначе вызывается метод drink().
    Реализовать метод getDanceStylesForGenre() в классе NightClub, который возвращает стили танца, связанные с заданным жанром музыки.
    В контроллере NightClubController создать экземпляры моделей Person, NightClub и Genre, и использовать их для запуска вечеринки в ночном клубе.
    Создать миграции для создания таблиц в базе данных, если необходимо.
Модель BodyPartMovement:

Модель BodyPartMovement представляет движения определенной части тела при танце.

    private $bodyPart: Строковое свойство, которое хранит название части тела, к которой относятся движения.
    private $movements: Массив, который содержит список движений для данной части тела.

Методы:

    public function getBodyPart(): string: Возвращает название части тела.
    public function getMovements(): array: Возвращает список движений для данной части тела.
--------------------------------
Модель Genre:

Модель Genre представляет жанр музыки.

    private $name: Строковое свойство, которое хранит название жанра.

Методы:

    public function getName(): string: Возвращает название жанра.
--------------------------------
Модель NightClub:

Модель NightClub представляет ночной клуб и управляет его функциональностью.

    private $musicGenre: Объект класса Genre, представляющий текущий жанр музыки в клубе.
    private $people: Массив, содержащий объекты класса Person, представляющие посетителей клуба.

Методы:

    public function setMusicGenre($genre): Устанавливает текущий жанр музыки в клубе.
    public function addPerson($person): Добавляет объект класса Person в список посетителей клуба.
    public function startParty(): Запускает вечеринку в клубе. Для каждого посетителя выполняет проверку, может ли он танцевать под текущий жанр музыки. Если может, вызывает метод dance(), иначе вызывает метод drink().
    public static function getDanceStylesForGenre($genre): Статический метод, возвращающий стили танцев для указанного жанра музыки.
--------------------------------
Модель Person:

Модель Person представляет посетителя ночного клуба.

    private $name: Строковое свойство, которое хранит имя посетителя.
    private $danceStyles: Массив, содержащий названия стилей танцев, которыми владеет посетитель.
    private $bodyPartMovements: Массив, содержащий объекты класса BodyPartMovement, представляющие движения частей тела при танце для данного посетителя.

Методы:

    public function canDanceToGenre($genre): Проверяет, может ли посетитель танцевать под указанный жанр музыки. Возвращает булево значение.
    public function dance(): string: Выполняет танец и возвращает строку с описанием движений, которые выполняет посетитель.
    public function drink(): Выводит сообщение о том, что посетитель пьет водку за баром.