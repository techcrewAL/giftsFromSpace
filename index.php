<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Postcard</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="http://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>	
</head>
<body>
	
	<div class="menu">
		<h1>What do you wish to send this postcard for?</h1>

		<span class="info">Your wish is unique. We'll find an unique photo from our endless universe just for your wish.</span>

		<div class="content">
			<ul>
				<li><a href="index.php?type=new_born">Welcome a newborn</a></li>
				<li><a href="index.php?type=birthday">Wish a birthday / an anniversary</a></li>
				<li><a href="index.php?type=love">Express love</a></li>				
				<li><a href="index.php?type=custom" >Custom</a></li>
			</ul>

		</div>

	</div>

	<div class="menu" id="custom">
		<form action="postcard.php" method="get"  style="margin-top:-80px;">
			<input type="hidden" name="type" value="<?= $_GET['type']; ?>">
			<input type="text" name="name" placeholder="What is your name?" style="width:400px; border:none; border-bottom:1px dotted #fff; margin-bottom:20px;" />
			<span class="blue">Write your wish</span>

			<textarea name="wish" id="wish" cols="70" rows="3"></textarea>
			
			<div class="clear" style="margin-top:10px;"></div>
			<span class="blue">Choose a photo from the </span>

			<div class="categories">
			  <label>
			    <input type="radio" name="photo" value="photoOfDay"/>
			    <img class="img-circular"  src="http://placehold.it/80x80/fff/DF0101&text=<?= date("d"); ?>">
			    <span>Day</span>
			  </label>

			  <label>
			    <input type="radio" name="photo" value="sun" />
			    <img class="img-circular" src="img/sun.jpg">
			    <span>Sun</span>
			  </label>

			  <label>
			    <input type="radio" name="photo" value="earth" />
			    <img class="img-circular"  src="img/earth.jpg">
			    <span>Earth</span>
			  </label>		
			  </div>

			  <label>
			    <input type="radio" name="photo" value="milky" />
			    <img class="img-circular"  src="img/milky.jpg">
			    <span>Milky Way</span>
			  </label>	

			  <label>
			    <input type="radio" name="photo" value="random" />
			    <img class="img-circular"  src="http://placehold.it/80x80/fff/DF0101&text=random()">
			    <span>Random</span>
			  </label>	

			<div class="clear"></div>
			<div class="input-data">
				<span class="blue">On this date</span>
				<input type="text" name="month" placeholder="MM">
				<input type="text" name="day" placeholder="DD">
				<input type="text" name="year" placeholder="YYYY">
				<span class="blue"><small>If you don't provide a date, the default date is today.</small></span>
			</div>
			<input type="submit" value=" Generate postcard ">
		</form>
	</div>

	<script type="text/javascript">

		<?php if(isset($_GET['type'])) { ?> 
			$(document).ready(function(){
				$('html, body').animate({
		            scrollTop: $("#custom").offset().top
		        }, 500);
		       });

		<?php } ?>
	</script>
</body>
</html>