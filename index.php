<?php
	try {
		$conn = new PDO( 'mysql:host=localhost;dbname=blog_db', 'root', '');
	
	
		$json = file_get_contents('https://jsonplaceholder.typicode.com/posts');
		$obj = json_decode($json, TRUE);
		

		$stmt = $conn->prepare("INSERT INTO blog_db.posts (userId,id,title,body) VALUES (:userId,:id,:title,:body)");

		
		foreach($obj as $item) {
    			$stmt->bindValue(":userId", $item['userId']);
    			$stmt->bindValue(":id", $item['id']);
    			$stmt->bindValue(":title", $item['title']);
			$stmt->bindValue(":body", $item['body']);  
    			$stmt->execute();
			}


		$json1 = file_get_contents('https://jsonplaceholder.typicode.com/comments');
		$obj1 = json_decode($json1, TRUE);

		$stmt1 = $conn->prepare("INSERT INTO blog_db.comments (postId,id,name,email,body) VALUES (:postId,:id,:name,:email,:body)");

		foreach($obj1 as $item) {
    			$stmt1->bindValue(":postId", $item['postId']);
    			$stmt1->bindValue(":id", $item['id']);
			$stmt1->bindValue(":name", $item['name']);
    			$stmt1->bindValue(":email", $item['email']);
			$stmt1->bindValue(":body", $item['body']);  
    			$stmt1->execute();
			}
		
		echo("<script>console.log('Загружено " . count($obj) . " записей и " . count($obj1) . " комментариев');</script>");

	
	} catch (PDOException $e) {
    		print "Error: " . $e->getMessage();
	}
?>