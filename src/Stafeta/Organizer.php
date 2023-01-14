<?php


namespace Stafeta;


use PDO;

class Organizer {
    static $instance = null;
    private $id = null;
    private $trophy;
    private $name;
    private $phase;

    const PHASE_MASTER = 'Master';
    const PHASE_CHALLENGE = 'Challenge';
    const PHASE_AMICAL = 'Amical';



    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Organizer(self::get());
        }

        return self::$instance;
    }
    public static function get()
    {
        global $odb;
        $statement = $odb->prepare("SELECT * FROM organizer ORDER BY id_organizer DESC LIMIT 0,1");
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        return $item;
    }

    public function __construct($data = array())
    {
        if (isset($data['id_organizer'])) {
            $this->setId($data['id_organizer']);
        }
        if (isset($data['name_trophy'])) {
            $this->setTrophy($data['name_trophy']);
        }
        if (isset($data['name_organizer'])) {
            $this->setName($data['name_organizer']);
        }
        if (isset($data['phase_trophy'])) {
            $this->setPhase($data['phase_trophy']);
        }
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTrophy()
    {
        return $this->trophy;
    }

    /**
     * @param mixed $trophy
     */
    public function setTrophy($trophy)
    {
        $this->trophy = $trophy;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * @param mixed $phase
     */
    public function setPhase($phase)
    {
        $this->phase = $phase;
    }

    /**
     * @return bool
     */
    public function isMaster()
    {
        return $this->getPhase() == self::PHASE_MASTER;
    }

    /**
     * @return bool
     */
    public function isChallenge()
    {
        return $this->getPhase() == self::PHASE_CHALLENGE;
    }

    /**
     * @return bool
     */
    public function isAmical()
    {
        return $this->getPhase() == self::PHASE_AMICAL;
    }
}