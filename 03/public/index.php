<?php
  $controller = $_GET['controller'] ?? 'default';
  $action = $_GET['action'] ?? 'index';

  $controllers_path = '../controllers';
  
  $controller_path = $controllers_path . '/' . $controller . '.php';
 
  if(file_exists($controller_path)) {
    include $controller_path;
    $class = $controller . 'Page';
    if(class_exists($class)) {
      $o = new $class;
      if(method_exists($class, $action)) {
        $data = $o->$action();

        $layout = $data['layout'] ?? 'layout';
        $title = $data['title'] ?? 'App';
        
        $view_name = $controller . '_' . $action;

        $content = load_view($view_name, $data);

        echo load_view($layout, ['content' => $content, 'title' => $title]);
      } else {
        echo 'Action not found - error 404';
      }
    } else {
      echo 'Page not found - error 404';
    }
  } else {
    echo 'Page not found - error 404';
  }


  function load_view($view_name, $params) {
    $views_folder = '../views';
    $view_path = $views_folder . '/' . $view_name . '.php';
    if(file_exists($view_path)) {
      extract($params);
      ob_start();
      include $view_path;
      $results= ob_get_contents();
      ob_end_clean();
      return $results;
    } else {
      echo 'View not found';
    }
  }




  class Model {

    protected $tableName;
    private $pdo;

    function __construct($dbConfig) {
        extract($dbConfig);
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $username, $pass, $options);
       } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
       }    
    }

    function Query($sql, $params = []) {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return $query;
    }

    function Get($id) {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id = :id';
        return $this->Query($sql, ['id' => $id])->fetch();
    }

    function GetAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        return $this->Query($sql)->fetchAll();
    }

    function Create($model) {
        $sql = 'INSERT INTO ' . $this->tableName;
        $sql .= '(' . implode(', ', array_keys($model)) . ')';
        $sql .= 'VALUES';
        $sql .= '(:' . implode(', :', array_keys($model)) . ')';
        return $this->Query($sql, $model);
    }

    function Update($model) {
        $sql = 'UPDATE Users SET ';
        $fields = [];
        foreach(array_keys($model) as $field) {
          $fields[] = $field . ' = :' . $field;
        }
        $sql .= implode(', ', $fields);
        $sql .= ' WHERE id=:id';
        return $this->Query($sql, $model);
    }

    function Delete($id) {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE id=:id';
        return $this->Query($sql, ['id' => $id]);
    }

}


function load_model($model) {
  $model_folder = '../models';
  $model_path = $model_folder . '/' . $model . '.php';
  if(file_exists($model_path)) {
    include($model_path);
    $className = $model . 'Model';
    if(class_exists($className)) {
      $params = parse_ini_file('../.env');
      $obj = new $className($params);
      return $obj;
    } else {
      echo 'No class found';
    }
  } else {
    echo 'No file found';
  }
}