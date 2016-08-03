<?php 

class User 
{
    public static function checkUserData($name, $password)
    {
        $db = Db::getInstance();

        $result = $db->connection->prepare("SELECT * FROM users WHERE name = ? AND password = ?");
        $result->bind_param('ss', $name, $password);
        $result->execute();
        
        $arrUser = $result->get_result();
        while($row = $arrUser->fetch_array(MYSQL_ASSOC)) {
            $user = $row;
        }

        if ($user) {
            return $user['id'];
        }
        return false;
    }

    public static function getUserById($userId)
    {
        $db = Db::getInstance();

        $result = $db->connection->prepare("SELECT * FROM users WHERE id = ?");
        $result->bind_param('i', $userId);
        $result->execute();
        
        $arrUser = $result->get_result();
        while($row = $arrUser->fetch_array(MYSQL_ASSOC)) {
            $user = $row;
        }
        return $user;
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }


    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header('location: /login');
    }

	public static function checkEmail($email)
	{
		if (preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)) {
			return true;
		}
	}

	public static function checkName($name)
	{
        if (strlen($name) >= 2 && strlen($name) <= 15) {
            return true;
        }
        return false;
	}

	public static function checkText($text)
	{
        if (strlen($text) >= 2  && strlen($text) <= 50) {
            return true;
        }
        return false;
	}

    public static function checkPassword($password)
    {
        if (strlen($password) >= 6 && strlen($password) <= 15) {
            return true;
        }
        return false;
    }

    public static function checkPost(array $post)
    {
        foreach ($post as $postName => $value) {
            $data[$postName] = htmlspecialchars(trim($value));
        }
        return $data;
    }

    public static function checkFile(array $file)
    {
        if ($_FILES['file']['size'] < 200*1000*1000
            && $_FILES["file"]["type"] == "image/jpeg") {
            return true;
        }
        return false;
    }
}