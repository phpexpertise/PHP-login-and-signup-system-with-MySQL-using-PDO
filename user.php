<?php
class User{	
	private $db;
	/**
	 * Function name : __construct
	 * Description   : This function is helps to initailze db connection
	 * @params : $db_connect	 
	 */
	public function __construct($db_connect){
		$this->db	=	$db_connect;
	}
	/**
	 * Function name : login
	 * Description   : validate to correct username and password for authentication purpose
	 * @params : $username (string),$password (string)
	 * @return : true / false
	 */
	public function login($username,$password){
		try{
			$stmt	=	$this->db->prepare("select * from users where username=:username and password=:password LIMIT 1");
			$stmt->execute(array(":username"=>$username,":password"=>$password));
			$userRow= 	$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0){
				$_SESSION['user_id'] =  $userRow['id'];
				$_SESSION['username'] =  $userRow['username'];
				return true;
			} else {
				return false;
			}
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}
	/**
	 * Function name : is_logged
	 * Description   : Check the session present or not
	 * @params : none
	 * @return : true / false
	 */
	public function is_logged(){
		if(isset($_SESSION['user_id'])){
			return true;
		}
	}
	/**
	 * Function name : logout
	 * Description   : clear the session
	 * @params : none
	 * @return : true
	 */
	public function logout() {
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
   
	/**
	 * Function name : set_error
	 * Description   : return the error message for its corresponding error code
	 * @params : $msg (string)
	 * @return : error message
	 */
	public function set_error($msg){
		include 'error_code.php';
		return $error[$msg];
	}
	/**
	 * Function name : redirect
	 * Description   : redirect the url
	 * @params : $filename (string)
	 * @return : redirect one page to another
	 */
	
	public function redirect($filename){
		header("location:".$filename);
	}
	/**
	 * Function name : checkavailability
	 * Description   : This function is helps to check the data is already present in the table.
	 * @params : $field (string),$value (string)
	 * @return : true / false
	 */
	public function checkavailability($field,$value){
		try{ 
			$stmt = $this->db->prepare("SELECT * FROM users WHERE $field=:$field LIMIT 1");
			$stmt->execute(array(":$field"=>$value));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 0)
			{
				return true;
			} else {
				return false;
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	/**
	 * Function name : addUser
	 * Description   : This function is helps to insert the users details into table
	 * @params : $username (string),$email (string),$password (string)
	 * @return : true / false
	 */
	public function addUser($username,$password){
		try{
			$stmt	=	$this->db->prepare("INSERT INTO users(`username`,`password`) values(:username,:password)");
			$stmt->bindparam(":username", $username);
			$stmt->bindparam(":password", $password);            
			$stmt->execute(); 
			if($stmt->rowCount()>0){
				return true;
			} else {
				return false;
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
}
?>