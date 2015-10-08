<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />
<title><?php echo $title_for_layout; ?></title>

<?php
echo $this->Html->css('style.css');

echo $this->Html->script('//code.jquery.com/jquery-1.11.0.min.js');
echo $this->Html->script('//code.jquery.com/ui/1.10.3/jquery-ui.js');
echo $this->Html->script('jquery.ah-placeholder');

// プログラム内からの内容の読み込み
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>

<script type="text/javascript">
$(function(){
	$('[placeholder]').ahPlaceholder({
		placeholderColor : 'silver',
		placeholderAttr : 'placeholder',
		likeApple : false
	});
});
</script>
</head>

<body>

<div id="main_body">

<!-- ▼ ヘッダー -->
<header>
	<div id="head_box_l">
		<h1 id="rogo"><a href="javascript:void(0);"></a></h1>
	</div>
	<div id="head_box_r"></div>
	<div class="c"></div>
</header>
<!-- ▲ ヘッダー -->

<?php echo $this->fetch('content'); ?>
</div>

<!-- ▼ フッター -->
<footer>
	<nav>
		<ul>
			<!--
			<li><a href="mailto:{$company->email}">お問い合わせ</a>&nbsp;|&nbsp;</li>
			<li><a href="/policy" target="_blank">iPost利用規約</a>&nbsp;|&nbsp;</li>
			<li><a href="/privacy" target="_blank">プライバシーポリシー</a></li>
			-->
		</ul>
	</nav>
	<div class="c"></div>
	<div id="copy_box">Copyright <?php echo date('Y');?> iPost</div>
</footer>
<!-- ▲ フッター -->

<!--ADRESU_KAKUSHI-->
<script type="text/javascript">
window.onload = function(){
if(document.body.scrollTop == 0){
setTimeout(function(){scrollTo(0,1)}, 1);
}
};
</script>

</div>

</body>
</html>

