<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Postcard</title>
	<link rel="stylesheet" href="css/style2.css">
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "aac4c2a9-79fe-465e-9312-14494973272e", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>	
</head>
<body>
	<?php
		$DB = array('LLOJI' 	  => 'mysql',
			    	'HOST' 		  => 'localhost',
			   	    'PERDORUESI'  => 'root',
			    	'FJALEKALIMI' => 'root',
			    	'EMRI' 		  => 'postcard');


		try {
		    $db = new PDO($DB['LLOJI'] . ':host=' . $DB['HOST'] . ';dbname=' . $DB['EMRI'], $DB['PERDORUESI'], $DB['FJALEKALIMI']);

		} catch (PDOException $e) {
		    print "Gabim!: " . $e->getMessage() . "<br/>";
		    die();
		} 
	?>

	<?php include 'libs/functions.php'; ?>

	<?php if ( isset($_GET['photo']) ) {

		$name 	= isset( $_GET['name'] ) ? $_GET['name'] : null;
		$wish 	= isset( $_GET['wish'] ) ? $_GET['wish'] : null;
		$type 	= isset( $_GET['type'] ) ? $_GET['type'] : null;
		$photo 	= isset( $_GET['photo'] ) ? $_GET['photo'] : null;
		$day 	= isset( $_GET['day'] ) ? $_GET['day'] : date("d");
		$month 	= isset( $_GET['month'] ) ? $_GET['month'] : date("m");
		$year 	= isset( $_GET['year'] ) ? $_GET['year'] : date("Y");		
		$photo_path = null;

		switch ($_GET['photo']) {
			case 'photoOfDay':
				$photo_path = photo_of_the_day($month, $day, $year);
				break;
			case 'sun':
				$photo_path = photo_of_the_sun($month, $day, $year);
				break;
			case 'earth':
				$photo_path = photo_of_the_earth();
				break;					
			case 'milky':
				$photo_path = photo_of_the_milky_way();
				break;	
			case 'random':
				$photo_path = random_photo();
				break;														
			default:
				# code...
				break;
		}

		$db->exec("INSERT INTO postcards(name, wish, type, photo, photo_url, date_added, day, month, year) VALUES('". $name ."', '". $wish ."', '". $type ."', '". $photo ."', '". $photo_path ."', NOW(), " . $day . ", ". $month .", ". $year .")");
		$id = $db->lastInsertId();
		
		echo $year;
		header("Location: http://localhost:8888/postcard/postcard.php?id=$id");

	} ?>

	<?php if ( isset( $_GET['id'] ) ) { ?>

		<div class="infotext">
			<?php $post_card = $db->query("SELECT * FROM postcards WHERE id = " . $_GET['id'])->fetchAll(PDO::FETCH_ASSOC); ?>
			<h1>Wall of memories</h1>

			<p>This is the posdcard we made for you. </p> 
			<p>You're free to send it by email.</p>
				<form action="" method="">		    
					<input type="email" placeholder="E-mail address">		    	
					<button>Send Postcard</button>
				</form>
			<p>Or copy the URL and share it by yourself.</p>
			
			<input type="text" value="http://localhost:8888<?= $_SERVER['REQUEST_URI'] ?>" />

			<div class="share">
				<span class='st_sharethis_large' displayText='ShareThis'></span>
				<span class='st_facebook_large' displayText='Facebook'></span>
				<span class='st_twitter_large' displayText='Tweet'></span>
				<span class='st_linkedin_large' displayText='LinkedIn'></span>
				<span class='st_pinterest_large' displayText='Pinterest'></span>
				<span class='st_email_large' displayText='Email'></span>
			</div>

			<div class="more-info">
			This postcard was sent by <?= $post_card[0]['name'] ?> </br> on <?= $post_card[0]['date_added'] ?>, 
				<?php
					switch ( $post_card[0]['type'] ) {
						case 'custom':
							echo ".";
							break;
						case 'new_born':
							echo " at your first heartbeat.";
							break;
						case 'birthday':
							echo " to wish you happy birthday.";
							break;
						case 'love':
							echo " to show some love.";
							break;														
						default:
							echo ".";
							break;
					}
				?>
			<p> Image courtesy of NASA. Developed by TECH CREW. </p>
			</div>
		
		</div>

		<div id="polaroid">
			<figure>
			<img src="<?= $post_card[0]['photo_url'] ?>" alt="Your postcard" style="width:500px;" />
			
			<figcaption>
			<?= $post_card[0]['wish']; ?>
			</figcaption>
			</figure>
		</div>

	<?php } ?>
</body>
</html>