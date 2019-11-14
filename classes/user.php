<?php
include('password.php');

//--------------------------------
// @author: Băcilă Andrei        |
//            (an4rei)           |
// @IDE: phpStorm                |
// @skype: freerunningparkour    |
//--------------------------------
/*

                                 ,--,
                               ,--.'|
                            ,--,  | :                   ,--,
                   ,---, ,---.'|  : '  __  ,-.        ,--.'|
               ,-+-. /  |;   : |  | ;,' ,'/ /|        |  |,
   ,--.--.    ,--.'|'   ||   | : _' |'  | |' | ,---.  `--'_
  /       \  |   |  ,"' |:   : |.'  ||  |   ,'/     \ ,' ,'|
 .--.  .-. | |   | /  | ||   ' '  ; :'  :  / /    /  |'  | |
  \__\/: . . |   | |  | |\   \  .'. ||  | ' .    ' / ||  | :
  ," .--.; | |   | |  |/  `---`:  | ';  : | '   ;   /|'  : |__
 /  /  ,.  | |   | |--'        '  ; ||  , ; '   |  / ||  | '.'|
;  :   .'   \|   |/            |  : ; ---'  |   :    |;  :    ;
|  ,     .-./'---'             '  ,/         \   \  / |  ,   /
 `--`---'                      '--'           `----'   ---`-'
*/
class User extends Password{

    private $_db;

    function __construct($db){
    	parent::__construct();

    	$this->_db = $db;
    }

	private function get_user_hash($username){

		try {
			$stmt = $this->_db->prepare('SELECT password, username, first_name, last_name, memberID FROM members WHERE username = :username AND active="Yes" ');
			$stmt->execute(array('username' => $username));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	public function login($username,$password){

		$row = $this->get_user_hash($username);

		if($this->password_verify($password,$row['password']) == 1){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['username'] = $row['username'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['memberID'] = $row['memberID'];
		    return true;
		}
	}

	public function is_admin(){

        $stmt = $this->_db->prepare('SELECT role FROM members WHERE username = :email');
        $stmt->execute(array(':email' => $_SESSION['username']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['role']=='admin'){
        	return true;
		}
    }

    public function get_user_data(){
        $stmt = $this->_db->prepare('SELECT * FROM members WHERE username = :email');
        $stmt->execute(array(':email' => $_SESSION['username']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       return $row;

    }

    public function get_user_fardata($username){
        $stmt = $this->_db->prepare('SELECT * FROM members WHERE username = :email');
        $stmt->execute(array(':email' => $username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;

    }

    public function get_user_tokendata($code){
        $stmt = $this->_db->prepare('SELECT username FROM members WHERE resetToken = :cod');
        $stmt->execute(array(':cod' => $code));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;

    }
	public function logout(){
		session_destroy();
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

}


?>
