<?php
	require('../wp-load.php');  
	global $wpdb;

	if(isset($_GET["id"]) AND !empty($_GET["id"])){
		$id = (int)$_GET["id"];
	}else{
		exit();
	}
	
	if(get_post( $id )){
		$query = new WP_Query( array( 
			'post_type' => 'place', 
			'posts_per_page' => 1, 
			'place-cat' => 'sluzhby-pomoshhi-prizyvnikam', 
			'p'=>$id,
			'fields' => 'ids'
		) );
		if(!$query->have_posts()){
			exit();
		}
	}else{
		exit();
	}


?>
<!DOCTYPE html>
<html class="ua_js_no" lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Рейтинг</title>
	<style>
	body, iframe{
		margin: 0;
		padding: 0;
		width:468px;
		height:60px;
		cursor: pointer;
	}
	
	</style>
</head>
<body>
	<canvas id="myCanvas" width="468" height="60" onclick="openURL()"></canvas>

	<script>
	var org = {
		'id' : <?php echo $id; ?>,
		'rating' : '<?php echo number_format(floatval(get_field("rating", $id)), 1); ?>',
		'votes' : '<?php echo get_org_rewiews_count($id); ?>',
	};

	function openURL() {
		window.open('https://povestka.by/place/'+org.id+'/#reviews', '_blank');
	}
	
	function num2str(n, text_forms) {  
		n = Math.abs(n) % 100; var n1 = n % 10;
		if (n > 10 && n < 20) { return text_forms[2]; }
		if (n1 > 1 && n1 < 5) { return text_forms[1]; }
		if (n1 == 1) { return text_forms[0]; }
		return text_forms[2];
	}

		
	function drawStar(cx,cy,spikes,outerRadius,innerRadius){
		var rot=Math.PI/2*3;
		var x=cx;
		var y=cy;
		var i;
		var step=Math.PI/spikes;
		context.beginPath();
		context.moveTo(cx,cy-outerRadius);
		for(i=0;i<spikes;i++){
			x=cx+Math.cos(rot)*outerRadius;
			y=cy+Math.sin(rot)*outerRadius;
			context.lineTo(x,y);
			rot+=step;

			x=cx+Math.cos(rot)*innerRadius;
			y=cy+Math.sin(rot)*innerRadius;
			context.lineTo(x,y);
			rot+=step;
		}

		context.lineTo(cx,cy-outerRadius);
		context.closePath();
		context.lineWidth=5;
		context.strokeStyle='orange';
		context.stroke();
		context.fillStyle='orange';
		context.fill();
	}

	function drawStarWhite(cx,cy,spikes,outerRadius,innerRadius){
		var rot=Math.PI/2*3;
		var x=cx;
		var y=cy;
		var i;
		var step=Math.PI/spikes;
		context.beginPath();
		context.moveTo(cx,cy-outerRadius);
		for(i=0;i<spikes;i++){
			x=cx+Math.cos(rot)*outerRadius;
			y=cy+Math.sin(rot)*outerRadius;
			context.lineTo(x,y);
			rot+=step;

			x=cx+Math.cos(rot)*innerRadius;
			y=cy+Math.sin(rot)*innerRadius;
			context.lineTo(x,y);
			rot+=step;
		}
		context.lineTo(cx,cy-outerRadius);
		context.closePath();
		context.lineWidth=5;
		context.strokeStyle='orange';
		context.stroke();
		context.fillStyle='white';
		context.fill();
	}

	function drawStarHalf(cx,cy,spikes,outerRadius,innerRadius){
		var rot=Math.PI/2*3;
		var x=cx;
		var y=cy;
		var i;
		var step=Math.PI/spikes;
		context.beginPath();
		context.moveTo(cx,cy-outerRadius);
		for(i=0;i<spikes;i++){
			x=cx+Math.cos(rot)*outerRadius;
			y=cy+Math.sin(rot)*outerRadius;
			context.lineTo(x,y);
			rot+=step;

			x=cx+Math.cos(rot)*innerRadius;
			y=cy+Math.sin(rot)*innerRadius;
			context.lineTo(x,y);
			rot+=step;
		}
		context.lineTo(cx,cy-outerRadius);
		context.closePath();
		context.lineWidth=5;
		context.strokeStyle='orange';
		context.stroke();
		context.fillStyle='orange';
		context.fill();     
		context.beginPath();
		context.moveTo(cx,cy-outerRadius);
		for(i=0;i<spikes/2;i++){
			x=cx+Math.cos(rot)*outerRadius;
			y=cy+Math.sin(rot)*outerRadius;
			context.lineTo(x,y);
			rot+=step;

			x=cx+Math.cos(rot)*innerRadius;
			y=cy+Math.sin(rot)*innerRadius;
			context.lineTo(x,y);
			rot+=step;
		}
		context.lineTo(cx,cy-outerRadius);
		context.closePath();
		context.lineWidth=2;
		context.strokeStyle='orange';
		context.stroke();
		context.fillStyle='white';
		context.fill();
	}
	
	var canvas = document.getElementById('myCanvas');
	var context = canvas.getContext('2d');
	var imageObj = new Image();
	imageObj.src = 'https://povestka.by/api/logo2.png';
	imageObj.onload = function() {
		context.drawImage(imageObj, 0, 5);
	};
	if(org.votes > 0) {
		context.font = "20px Tahoma";
		context.fillText(org.rating + '/', 230, 30);
		context.font = "16px Tahoma";
		context.fillStyle = "grey";
		context.fillText('5', 265, 32);
	}
	var fillStar = org.rating.split('.')[0];
	var fillStarWhite = org.rating.split('.')[1];
	var whiteCount = 5 - fillStar;
	var space = 0;

	document.addEventListener('DOMContentLoaded', function(){
		if(org.votes > 0) {
//			var startstar = 277+17;
			var startstar = 230+50+26;
			var i;
			for ( i = 0; i < fillStar; i++) {
				drawStar(startstar + space,24 , 5 , 4 , 2 );
				space+=20;
			}
			if (whiteCount != 0){
				if (fillStarWhite <= 2) {
					for ( i = 0; i < whiteCount; i++) {
						drawStarWhite(startstar + space, 24, 5 , 4 , 2 );
						space+=20;
					}
				} else if(fillStarWhite < 8 && fillStarWhite >= 3) {
					drawStarHalf(startstar + space, 24, 5 , 4 , 2 );
					space+=20;
					whiteCount--;
					for ( i = 0; i < whiteCount; i++) {
						drawStarWhite(startstar + space, 24, 5 , 4 , 2 );
						space+=20;
					}
				} else if(fillStarWhite  >= 8) {
					drawStar(startstar + space, 24, 5 , 4 , 2 );
					space+=20;
					whiteCount--;
					for (i = 0; i < whiteCount; i++) {
						drawStarWhite(startstar + space, 24, 5 , 4 , 2 );
						space+=20;
					}
				}
			}
		}
	});

	if(org.votes > 0) {
		//количество голосов
		context.font = "20px Tahoma";
		context.fillStyle = "black";
		context.textAlign = "center";
		context.fillText(org.votes , 437, 25);
		// надпись оценок
		context.fillStyle = "#8e8e8e"; 
		context.font = "14px  OpenSans-Regular";
		context.textAlign = "center";
//		context.fillText('оценок' , 420, 37);
		context.fillText(num2str(org.votes, ['отценка', 'оценки', 'оценок']) , 437, 37);
	}else{
		context.fillStyle = "#000";
		context.font = "12px Tahoma";
		context.textAlign = "center";
		context.fillText('Оставьте первый отзыв!' ,359,  25);
	}
	
	//фон надиси центр прав призывника
	context.fillStyle = "#ebebeb";
	context.fillRect( 230, 40, 258, 20);
	//надпись центр прав призывника
	context.fillStyle = "#a8a6bf";
	context.font = "12px Tahoma";
	context.textAlign = "center";
	context.fillText('Рейтинг организации' ,359,  55);


	</script>
</body>
</html>