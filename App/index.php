<?php


global $pdo; //for pgsql connection
require 'config/database.php';
require 'models/Game.php';
require 'repositories/GameRepository.php';
require 'services/GameService.php';
require 'controllers/GameController.php';

$repository = new GameRepository($pdo);
$service = new GameService($repository);
$controller = new GameController($service);


// web api - 2 arg (method  && URI (global  variable _SERVER[req_met] , [req_uri] можно завардампить глянуть весь список )))

header('Content-Type: application/json');
//указываем в   заголовке запроса   тип данных json
//JSON — используется в REST-запросах.


$requestMethod = $_SERVER['REQUEST_METHOD'];
// trim — Удаляет пробелы (В нашем случае. слеши) из начала и конца строки с запроса.  rtrim - удалит в конце, itrim- в начале
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/') );
//explode — Разбивает строку с separator ('вводим нужный элемент') приобразует в массив ,
// ( explode вернет массив с индексами со значениями [0]=>/value[1]=>/value[2]=>/value[3]=>  и т.д   ...)
// теперь в последующем можем понимать глубину запроса  (выстраиваем маршрутизацию  по нужным ключам && условиям )
switch ($requestMethod) {
    case 'GET':
        if
        (count($requestUri) == 1 && $requestUri[0] === 'games')
        {
            echo $controller->getAllGames();
        }//+
        elseif
        (count($requestUri) == 2 && $requestUri[0] === 'games')
        {
            echo $controller->getGameById($requestUri[1]);
        }//+
        elseif
        (count($requestUri) == 3 && $requestUri[0] === 'games' && $requestUri[1] === 'genres')
        {
            echo $controller->getGamesByGenre($requestUri[2]);
            // в таблице можно указать все категории через запятую либо  , если найдется нужная среди списка попадет в результатирующий набор
            // благодоря match pattern LIKE в SQL  % requestUri[2] %
        } // +
        break;
        // GET - затестил в постман
    case 'POST':
        if ($requestUri[0] === 'games') {
            $data = json_decode(file_get_contents('php://input'),true);
            //  теперь data вернет асс-ый массив , данные в масиве будут помещены из тела POST самого запроса )(указываю в row постман)
            echo $controller->addGame($data);
            //передали массив в контроллер
        } // +
        break;
        //передача -  работает !
    case 'PUT':
        if (count($requestUri) == 2 && $requestUri[0] === 'games') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo $controller->updateGame($requestUri[1], $data);
        }//+
        //обновление данных -  работает !

        break;
    case 'DELETE':
        if (count($requestUri) == 2 && $requestUri[0] === 'games') {
            echo $controller->deleteGame($requestUri[1]);
        }
        // удаление  - работает !
        break;
    default:
        http_response_code(405);
        echo json_encode(['упс , ошибочка ' => ' вы выбрали недопустимый метод']);
        break;
        // в случае передачи в заголовке http не существуего метода
}
