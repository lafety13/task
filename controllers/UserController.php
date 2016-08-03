<?php 

class UserController
{
    public function actionIndex()
    {        
        require_once (ROOT . '/views/user/index.php');
        return true;
    }

	public function actionLogin() 
	{
        $name = false;
        $password = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];

            $errors = false;

            $userId = User::checkUserData($name, $password);

            if ($userId == false) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                User::auth($userId);
                
                header("Location: /cabinet");
            }
        }

        require_once (ROOT . '/views/user/login.php');
        return true;
	}

    public function actionLogout()
    {
        unset($_SESSION['user']);

        header('location: /');
        return true;
    }
}