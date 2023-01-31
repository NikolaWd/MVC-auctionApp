<?php

    namespace App\Models;
    use App\Core\DatabaseConnection;

    class CategoryModel 
    {
        private $dbc;
        
        public function __construct(DatabaseConnection &$dbc)
        {
            $this->dbc = $dbc;
        }

        public function getById(int $userId)
        {
            $sql = "SELECT * FROM category WHERE category_id = ?;";
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([ $userId ]);

            $category = NULL;
            if($res)
            {
                $category = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $category;
        }

        public function getAll(): array 
        {
            $sql = "SELECT * FROM category";
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute();
            $categories = [];
            if($res)
            {
                $categories = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $categories;
        }
    }

?>