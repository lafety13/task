<?php

class Feedback 
{
	public static function upload()
	{
		$uploadfile = ROOT. '/tamplate/uploaded/' . rand(0, (999*999)) . basename($_FILES['file']['name']);
		copy($_FILES['file']['tmp_name'], $uploadfile);
		return $uploadfile;
	}

	public static function addPost(array $post, $img)
	{
		$db = Db::getConnection();

		$result = $db->prepare("INSERT INTO reviews (name, email, text, date, img) 
			VALUES (:name, :email, :text, :date, :img)");

		$result->bindParam(':name', trim($post['name']), PDO::PARAM_STR);
		$result->bindParam(':email', trim($post['email']), PDO::PARAM_STR);
		$result->bindParam(':text', trim($post['text']), PDO::PARAM_STR);
		$result->bindParam(':date', date("Y-n-j"), PDO::PARAM_STR);
		$result->bindParam(':img', $img, PDO::PARAM_STR);
		$result->execute();

		header('location: ' . $_SERVER['REDIRECT_URL']);
		exit();
	}

	public static function getReviews()
	{
		$db = Db::getConnection();

		$reviews = $db->query("SELECT * FROM reviews ORDER BY date DESC");
		while ($row = $reviews->fetch()) {
			$allReviews[] = $row;
		}
		if (!empty($allReviews)) {
			return $allReviews;
		}
		return false;
	}

	public static function getReviewById($id)
	{
		$db = Db::getConnection();

		$result = $db->prepare("SELECT * FROM reviews WHERE id = :id");
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->execute();


        while($row = $result->fetch()) {
            $review = $row;
        }
		return $review; 
	}
	
	public static function getTotalReviews()
	{
		$db = Db::getConnection();

		$result = $db->connection->query('SELECT COUNT(*) FROM reviews');
		$total = mysqli_fetch_array($result); 
		return $total[0];
	}

	public static function previewByAjax(array $post)
	{
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
			!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	   			$text = str_replace(
				array("%name%", "%text%"), 
				array($post['name'], $post['text']), 
				file_get_contents(ROOT . '/tamplate/tmp/preview.tpl')
				);
				return $text;
		}
		return false;
	}
	public static function update($id, array $post)
	{
		$db = Db::getConnection();

		$review = $db->prepare("UPDATE reviews SET text = :text, edit = 1 WHERE id = :id");
		$review->bindParam(':text', $post['text'], PDO::PARAM_STR);
		$review->bindParam(':id', $id, PDO::PARAM_INT);
		$review->execute();

		header('location: /admfeedback');
	}

	public static function confirmUpdate($id)
	{
		$db = Db::getConnection();

		$review = $db->prepare("UPDATE reviews SET confirm = 1 WHERE id = :id");
		$review->bindParam(':id', $id, PDO::PARAM_STR);
		$review->execute();

		header('location: /unconfirmed');
	}
}