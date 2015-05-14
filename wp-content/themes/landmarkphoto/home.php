<?php get_header() ?>

<header></header>

<div id="cover"></div>

<div id="home-actions">
	<button type="button" id="attend"><img src="<?=get_stylesheet_directory_uri()?>/images/button-text-attend.png" alt="马上参与"></button>
	<button type="button" id="show-policy"><img src="<?=get_stylesheet_directory_uri()?>/images/button-text-policy.png" alt="参赛须知"></button>
</div>

<div id="policy" class="hide">
<?=wpautop(get_posts(array('name'=>'policy'))[0]->post_content)?>
</div>

<div id="attend-form" class="hide">
	<form method="post">
		<div class="form-group" id="name">
			<label class="form-label"><img src="<?=get_stylesheet_directory_uri()?>/images/text-name.png" alt="姓名"></label>
			<input type="text" name="name">
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
			<button type="submit" id="submit"><img src="<?=get_stylesheet_directory_uri()?>/images/button-text-submit.png" alt="提交"></button>
		</div>
	</form>
</div>

<script type="text/javascript">
jQuery(function($){

	$('button#attend').on('click', function(){
		$('body').addClass('attend-form-open');
		$('#home-actions, #policy').hide();
		$('#attend-form').fadeIn(500);
	});

	$('button#show-policy').on('click', function(event){
		$('#policy').toggle(500);
		event.stopPropagation();
	});

	$('#policy').on('click', function(event){
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