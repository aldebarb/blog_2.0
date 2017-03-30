<?php
 //Schema
    //forum (post_id, user_id, post_title, post_blog, post_date, post_time)
    //users (user_id, first_name, last_name, birth_date)
    //user_login(login_id, user_id, email_address, password_hash)
class Forum
{
	private $postId;
	public $userId;
	public $postTitle;
	public $postContent;
	public $postDate;
	public $postTime;

	public function __construct($postId)
	{
		$this->postId = $postId;
	}

	public function save($mysqli)
	{
		if ($this->postId == 0) {
			$this->createPost($mysqli);

		} else {
			$this->updatePost($mysqli);
		}
	}

	public function createPost($mysqli)
	{
		$mysqli->query("INSERT INTO forum (user_id, post_title, post_blog, post_date, post_time) VALUES '$this->userId', '$this->postTitle', '$this->postContent', '$this->postDate', '$this->postTime'");
	}

	public function updatePost($mysqli)
	{
		$mysqli->query("UPDATE forum SET user_id = '$this->userId', post_title = '$this->postTitle', post_blog = '$this->postContent', post_date = '$this->postDate', post_time = '$postTime' WHERE post_id = '$this->postId'");
		//Can always make more tables for date_created, last_updated_date etc...
	}

	public function deletePost($mysqli)
	{
		$mysqli->query("DELETE FROM forum WHERE post_id = '$this->postId'");
	}
}