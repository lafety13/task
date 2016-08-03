<?php

class SiteController
{
	public function actionIndex() {
		require_once (ROOT . '/views/site/index.php');
		return true;
	}
	public function actionFeedback()
	{
		$errors = false;
		$path = '';

		if (isset($_POST['submit'])) {
			if (!User::checkEmail($_POST['email'])) {
				$errors[] = 'Некоректнй email';
			}
			if (!User::checkName($_POST['name'])) {
				$errors[] = 'Некоректное имя';
			}
			if (!User::checkText($_POST['text'])) {
				$errors[] = 'Некоректный коментарий';
			}
			if (!User::checkFile($_FILES['file'])) {
				$errors[] = 'Слишком большой файл или неподходящий формат';
			}
			if ($errors == false) {
				if (isset($_FILES['file'])) {
					$pathFile = ROOT . '/tamplate/uploaded/';
					$file = Feedback::upload();;
					$img = new Resize($file);
					$img->cropSquare(100, 200, 500);
					$img->resize(320, 240);
					$fname = rand(1000, (9999 * 999 * 999));
					$path = $img->save($pathFile, $fname, 'jpg', false, 100); 
					//print_r($path);
					Feedback::addPost($_POST, $fname);
				}
			}
		}
		$reviews = Feedback::getReviews();

		require_once (ROOT . '/views/site/feedback.php');
		return true;
	}

	public function actionPreview()
	{
		if (isset($_POST)) {
			$post = User::checkPost($_POST);
			echo Feedback::previewByAjax($post);
		}
		return true;
	}


}