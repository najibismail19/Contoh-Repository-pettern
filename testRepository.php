<?php 
require_once __DIR__ . "/Model/Comment.php";
require_once __DIR__ . "/getConnection.php";
require_once __DIR__ . "/Repository/CommentRepository.php";

use Repository\CommentRepositoryImpl;
use Model\Comment;

$connection = getConnection();
$repository = new CommentRepositoryImpl($connection);

$najib =  new Comment(email: "Dewi@yahoo.com", comment: "Hiii...");
var_dump($repository->findAll());