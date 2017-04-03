<?php
//Schema 
//Forum(post_id, user_id, post_title, post_blog, post_date, post_time)
$result = $mysqli->query("SELECT forum.post_title, user_login.email_address, forum.post_date, forum.post_time, forum.post_blog, forum.post_id FROM forum JOIN user_login ON forum.user_id = user_login.user_id ORDER BY forum.post_id DESC");

if ($result->num_rows > 0) {
			
	while ($row = $result->fetch_assoc()) {
		print "<h2>" . $row['post_title'] . "</h2>";
		print "<p>" . $row['post_blog'] . "</p>";
		print "<p>Posted by " . $row['email_address'] . " on " . $row['post_date'] . " at " . $row['post_time'] . "</p>";

		print "<form method='post' action='admin/delete.php?postId=" . $row['post_id'] . "'>";
		print "<input type='submit' name='delete' value='Delete'>";
		print "<a href='home.php?p=edit&postId=" . $row['post_id'] . "'>Edit Post?</a>";
		print "</form>";
	}
} else {
	echo "Result should be empty";
}
?>