<?php


class GameController
{
    private $service;

    public function __construct(GameService $service)
    {
        $this->service = $service;
    }
    public function getAllGames()
    {
        return json_encode($this->service->getAllGames());
    }

    public function getGameById($id)
    {
        return json_encode($this->service->getGameById($id));
    }

    public function addGame($data)
    {
        $game = new Game($data['title'], $data['developer'], $data['genres']);
        // весь raw прелетевший с постмана передаем в конструктор модели game , создаем экземпляр класса , далее передаем его в service
        $this->service->addGame($game);
        return json_encode(['status' => 'игра успешно добавлена!']);
    }

    public function updateGame( $id, $data)
    {
        $game = new Game($data['title'], $data['developer'], $data['genres']);

        $this->service->updateGame($game, $id);
        return json_encode(['status' => 'игра бновлена']);
    }

    public function deleteGame($id)
    {
        $this->service->deleteGame($id);
        return json_encode(['status' => 'игра удалена']);
    }

    public function getGamesByGenre($genre)
    {
        return json_encode($this->service->getGamesByGenre($genre));
    }
}
