<?php
namespace Repository;
use Model\Comment;

interface CommentRepository {
    
    function insert(Comment $comment): comment;

    function findById(int $id): ?comment;

    function findAll(): array;
}

class CommentRepositoryImpl implements CommentRepository {
    public function __construct(private \PDO $connection)
    {   
    }

    public function insert(Comment $comment) : comment 
    {
        $sql = "INSERT INTO comments(email, comment) VALUES (? , ?)";
        $this->connection->prepare($sql)->execute([$comment->getEmail(), $comment->getComment()]);
        $id = $this->connection->lastInsertId();
        $comment->setId($id);
        return $comment;
    }

    public function findById(int $id): ?Comment
    {
        $sql = "SELECT * FROM comments WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);
        if($row = $statement->fetch()) {
            return new Comment (id : $row["id"],
                                email : $row["email"],
                                comment : $row["comment"]
         );
        } else {
            return null;
        }
    }

    public function findAll() : array
    {
        $sql = "SELECT * FROM comments";
        $result = $this->connection->query($sql)->fetchAll();
        $array = [];
        foreach($result as $value) {
            $array[] = new Comment(
                        id : $value["id"],
                        email : $value["email"],
                        comment : $value["comment"]
            );
        }
        return $array;
    }
}

