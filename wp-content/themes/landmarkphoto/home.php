<?php

if(isset($_POST['submit'])){

	include_once ABSPATH . 'wp-admin/includes/media.php';
	include_once ABSPATH . 'wp-admin/includes/file.php';
	include_once ABSPATH . 'wp-admin/includes/image.php';
	
	$photo_id = media_handle_upload('photo', 0);

	wp_update_post(array(
		'ID'=>$photo_id,
		'post_title'=>$_POST['attendee_name'] . ' - ' . $_POST['phone'],
	));

}

get_header()
?>

<header></header>

<?php if(isset($_POST['submit'])){ ?>
<div id="completed">
	<img src="<?=get_stylesheet_directory_uri()?>/images/qrcode.jpg">
	<h1>谢谢关注！</h1>
	<h1>请继续关注《申》报官方微信，<br>入围作品将进行网络投票</h1>
</div>
<?php }else{ ?>
<div id="cover"></div>

<div id="home-actions">
	<button type="button" id="attend"><img src="<?=get_stylesheet_directory_uri()?>/images/button-text-attend.png" alt="马上参与"></button>
	<button type="button" id="show-policy"><img src="<?=get_stylesheet_directory_uri()?>/images/button-text-policy.png" alt="参赛须知"></button>
</div>

<div id="policy" class="hide">
<?=wpautop(get_posts(array('name'=>'policy'))[0]->post_content)?>
</div>

<div id="attend-form" class="hide">
	<form method="post" enctype="multipart/form-data">
		<div class="form-group" id="name">
			<label class="form-label"><img src="<?=get_stylesheet_directory_uri()?>/images/text-name.png" alt="姓名"></label>
			<input type="text" name="attendee_name">
		</div>
		<div class="form-group" id="phone">
			<label class="form-label"><img src="<?=get_stylesheet_directory_uri()?>/images/text-phone.png" alt="手机"></label>
			<input type="number" name="phone">
		</div>
		<div class="form-group label notice">
			<img src="<?=get_stylesheet_directory_uri()?>/images/text-notice.png" alt="实名信息提示">
		</div>
		<div class="form-group" id="photo-upload">
			<div id="upload-title" class="label"><img src="<?=get_stylesheet_directory_uri()?>/images/text-form-title.png"></div>
			<img id="button-text-upload" src="<?=get_stylesheet_directory_uri()?>/images/button-text-upload.png" alt="点击上传">
			<img class="preview empty">
			<input type="file" name="photo" capture="camera">
		</div>
		<div class="form-actions">
			<button type="submit" name="submit" id="submit"><img src="<?=get_stylesheet_directory_uri()?>/images/button-text-submit.png" alt="提交"></button>
		</div>
	</form>
</div>
<?php } ?>

<script type="text/javascript">
jQuery(function($){

	$('button#attend').on('click', function(){
		$('body').addClass('attend-form-open');
		$('#home-actions, #policy').fadeOut(200);
		$('#attend-form').fadeIn(500);
	});

	$('button#show-policy').on('click', function(event){
		if($('#policy').is(':visible')){
			$('#policy').fadeOut(500);
		}else{
			$('#policy').fadeIn(500);
		}
		event.stopPropagation();
	});

	$('body').on('click', function(){
		$('#policy').fadeOut(500);
	});
	
	$('#photo-upload input[type="file"]').change(function(){
		
		var input = $(this);
		
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				input.siblings('img.preview').attr('src', e.target.result).removeClass('empty');
			}
			
			reader.readAsDataURL(this.files[0]);
		}
	});
	
});
</script>

<?php get_footer(); ?>