<?php
	try {
		$search = $_POST['search'];
		$search = "%$search%";
		$conn = new PDO( 'mysql:host=localhost;dbname=blog_db', 'root', '');
		


		
		$stmt = $conn->prepare("SELECT c.name,c.body,p.title,p.id,c.postId FROM blog_db.comments AS c INNER JOIN blog_db.posts AS p ON c.postId = p.id WHERE c.name LIKE ? OR c.body LIKE ?");
		
		$stmt->execute([$search,$search]);

		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($data as $k => $v){
  			echo '<h1>Заголовок: '.$v['title'].'</h1><b>Комментарий: '.$v['name'].'</b><br>'.$v['body'].'<br>';
			
			
		}

	
		
	

	
	} catch (PDOException $e) {
    		print "Error: " . $e->getMessage();
	}
?>