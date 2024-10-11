<?php


class GameService
{
    private $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllGames()
    {
        return $this->repository->getAllGames();
    }

    public function getGameById($id)
    {
        return $this->repository->getGameById($id);
    }

    public function addGame(Game $game)
    {
        $this->repository->addGame($game);
    }

    public function updateGame(Game $game, $id)
    {
        $this->repository->updateGame($game, $id);
    }

    public function deleteGame($id)
    {
        $this->repository->deleteGame($id);
    }

    public function getGamesByGenre($genre)
    {
        return $this->repository->getGamesByGenre($genre);
    }
}
