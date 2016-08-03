<?php 

class User 
{
    public static function checkUserData($name, $password)
    {
        $db = Db::getConnection();

        $result = $db->prepare("SELECT * FROM users WHERE name = :name AND password = :password");
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        
        
        while($row = $result->fetch()) {
            $user = $row;
        }

        if ($user) {
            return $user['id'];
        }
        return false;
    }

    public static function getUserById($userId)
    {
        $db = Db::getConnection();

        $result = $db->prepare("SELECT * FROM users WHERE id = :id");
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        $result->execute();
        
        while($row = $result->fetch()) {
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