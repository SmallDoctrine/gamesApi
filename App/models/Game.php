<?php

class Game
{
    public $title;
    public $developer;
    public $genres;

    public function __construct($title, $developer, $genres)
    {
        $this->title = $title;
        $this->developer = $developer;
        $this->genres = $genres;
    }
}