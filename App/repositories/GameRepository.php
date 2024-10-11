<?php


class GameRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllGames()
    {
        $stmt = $this->pdo->query("SELECT * FROM games");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGameById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM games WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addGame(Game $game)
    {
        $stmt = $this->pdo->prepare("INSERT INTO games (title, developer, genres) VALUES (?, ?, ?)");
        $stmt->execute([$game->title, $game->developer, $game->genres]);
    }

    public function updateGame(Game $game, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE games SET title = ?, developer = ?, genres = ? WHERE id = ?");
        $stmt->execute([$game->title, $game->developer, $game->genres, $id]);
    }

    public function deleteGame($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM games WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getGamesByGenre($genre)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM games WHERE genres LIKE ? ");
        $stmt->execute(['%' . $genre . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
