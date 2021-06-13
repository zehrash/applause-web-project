<?php

class Event {
    public $eventId;
    public $eventName;
    public $date;

    function __construct($eventId, $eventName, $date) {
        $this->eventId = $eventId;
        $this->eventName = $eventName;
        $this->date = $date;
    }

}

?>