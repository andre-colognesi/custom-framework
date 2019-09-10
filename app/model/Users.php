<?php
namespace app\model{
    include_once 'app/Bootstrap.php';
    
    use \app\config\database\Database as DB;
    use \app\config\session\Session as Session;
    use \app\web\Request as Request;
    class Users extends Model{
        protected $primaryKey = 'user_id';
        protected $table = 'users';
        
        public function insert(array $data){
            $db = new \app\config\database\Database();
            $db = $db->connect();
            $columns = [];
            $params = [];
            $execute = [];
            $values  = [];
            $i = 0;
            foreach($data as $k => $v){
                $columns[] = $k;
                $params[] =   (string)':'.$k;
                $values[$k] = $v;
                $i++;
            }
           
            $query = "INSERT INTO ".$this->table."(".join(",",$columns) . ") VALUES (".join(",",$params).")";
            $insert = $db->prepare($query);
            $insert->execute($values);
            if($insert->rowCount() == 1){
                return true;
            }
                return false;
            
        }


        public static function createUser($params){
            $self = new self;
            $connection = new DB();
            $db = $connection->connect();            
            $select = $db->prepare("SELECT login FROM users WHERE login = :login");
            $select->execute([":login" => $params['login']]);
            if($select->rowcount() > 0){
                Session::addMsg('Já existe um usúario cadastrado com esse login.','warning');
                return false;
            }
            $insert = array(
                'login' => $params['login'],
                'name'  => $params['name'],
                'email' => $params['email'],
                'password' => password_hash($params['password'],PASSWORD_BCRYPT)
             );
            $query = $self->insert($insert);
            if(!$query){
                return false;
            }
                $session = new Session();
                $session->initSession($insert);;

        }

        public function updateSettings($id, Request $request, $fileName){
            $data = array(
                "name"  => $request->name,
                "email" => $request->email,
                "avatar" => $fileName
            );
            if(!$this->update($id,$data)){
                return false;
            }
            $_SESSION['AVATAR'] = $fileName;
            return true;
            

        }

        public static function login($params){
            $connection = new DB();
            $db = $connection->connect();
            $query = $db->prepare("SELECT user_id,login, name, email, avatar, password from users where login = :login ");
            $query->execute(array(
                ':login' => $params['login'],            ));
            if($query->rowCount() == 1){
                $res = $query->fetch();
                if(password_verify($params['password'],$res['password'])){
                $session = new Session();
                Session::addMsg('Logado com sucesso!','success');
                $session->initSession($res);
                return true;
                }
            }
            Session::addMsg('Usuario e/ou senha invalidos.','warning');
            header("location: ".getenv("URL")."/login");
                
        }
    }
}