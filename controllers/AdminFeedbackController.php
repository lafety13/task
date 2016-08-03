<?php

class AdminFeedbackController extends AdminBase
{
	public function actionIndex()
	{
		self::checkAdmin();

		$errors = false;

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
			if ($errors == false) {
				Feedback::addPost($_POST);
			}
		}
		$reviews = Feedback::getReviews();

		require_once (ROOT . '/views/adminFeedback/index.php');
		return true;
	}

	public function actionEdit($id)
	{
		self::checkAdmin();

		$errors = false;

		$review = Feedback::getReviewById($id);

		if (isset($_POST['submit'])) {
			if (!User::checkText($_POST['text'])) {
				$errors[] = 'Некоректный коментарий';
			}
			if ($errors == false) {
				Feedback::update($id, $_POST);
			}
		}
		require_once (ROOT . '/views/adminFeedback/edit.php');
		return true;
	}

	public function actionUnconfirm($page = 1)
	{
		self::checkAdmin();

		$reviews = Feedback::getReviews();

		require_once (ROOT . '/views/adminFeedback/unconfirmed.php');
		return true;
	}

	public function actionConfirm($id)
	{
		self::checkAdmin();
		Feedback::confirmUpdate($id);


	}
}