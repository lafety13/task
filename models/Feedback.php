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
		$db = Db::getInstance();

		$result = $db->connection->prepare("INSERT INTO reviews (name, email, text, date, img) 
			VALUES (?, ?, ?, ?, ?)");

		$result->bind_param('sssss', 
			trim($post['name']), 
			trim($post['email']), 
			trim($post['text']),
			date("Y-n-j"),
			$img
		);
		$result->execute();

		header('location: ' . $_SERVER['REDIRECT_URL']);
		exit();
	}

	public static function getReviews()
	{
		$db = Db::getInstance();

		$reviews = $db->connection->query("SELECT * FROM reviews ORDER BY date DESC");
		while ($row = mysqli_fetch_array($reviews, MYSQL_ASSOC)) {
			$allReviews[] = $row;
		}
		if (!empty($allReviews)) {
			return $allReviews;
		}
		return false;
	}

	public static function getReviewById($id)
	{
		$db = Db::getInstance();

		$result = $db->connection->prepare("SELECT * FROM reviews WHERE id = ?");
		$result->bind_param('i', $id);
		$result->execute();

		$aReviews = $result->get_result();

        while($row = $aReviews->fetch_array(MYSQL_ASSOC)) {
            $review = $row;
        }
		return $review; 
	}
	
	public static function getTotalReviews()
	{
		$db = Db::getInstance();

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
		$db = Db::getInstance();

		$review = $db->connection->prepare("UPDATE reviews SET text = ?, edit = 1 WHERE id = ?");
		$review->bind_param('si', $post['text'], $id);
		$review->execute();

		header('location: /admfeedback');
	}

	public static function confirmUpdate($id)
	{
		$db = Db::getInstance();

		$review = $db->connection->prepare("UPDATE reviews SET confirm = 1 WHERE id = ?");
		$review->bind_param('s', $id);
		$review->execute();

		header('location: /unconfirmed');
	}
}