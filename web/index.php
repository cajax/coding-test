<?php
declare(strict_types=1);

use Teamleader\Controller\ApiController;

include '../vendor/autoload.php';

$requestBody = file_get_contents('php://input');

$apiController = new ApiController();


echo json_encode($apiController->indexAction($requestBody), JSON_PRETTY_PRINT);