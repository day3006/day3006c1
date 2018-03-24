<?php
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.js"></script>
	<title>Document</title>
</head>
<body>
	<div style="padding:100px 0;margin:auto;text-align: center;">
		<h2 style="text-align: center"><?php echo $mess?></h2>
		<a href="<?php echo $this->url;?>"><span id="time">5</span>后进行跳转,点击直接跳转</a>
	</div>

	<script>
		$(function(){
		   setInterval(function(){
		      var time= $('#time').html();
		      time--;
		      if(time==0){
				location.href='<?php echo $this->url;?>';
			  }
		      $('#time').html(time);
		   },1000)
		})
	</script>
</body>
</html>