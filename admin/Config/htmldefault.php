<?php
$lang = Configure::read('Config.language');
if($lang == 'vie' || $lang == 'vi') {
	$htmlDefault = <<<EOM

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>iPost</title>
	<link rel="stylesheet" type="text/css" href="/cms/css?userId=1" media="all" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes," />
</head>
<body>
	<div class="main">

		<img src="/img/cms/main.png" alt="Ảnh chính" class="main_photo" />

		<h2 class="title">NEW</h2>

		<div class="new_item_box line_gray">
			<img src="/img/cms/item1.png" alt="Ảnh sản phẩm" class="item_photo_new">
			<p class="item_title">Kirin</p>
			<p class="item_sub_title">Khắc gỗ của hươu cao cổ</p>
			<p class="honbun">Nó là một khắc gỗ của con búp bê đã được tạo ra bởi bàn tay của một nghệ nhân duy nhất.</p>
		</div>

		<div class="new_item_box line_gray">
			<img src="/img/cms/item2.png" alt="Ảnh sản phẩm" class="item_photo_new">
			<p class="item_title">Kotori</p>
			<p class="item_sub_title">Các loài chim</p>
			<p class="honbun">Các tổ chim bằng cành cây, lá đã trở thành một bông hoa khô.</p>
		</div>

		<div class="new_item_box">
			<img src="/img/cms/item3.png" alt="Ảnh sản phẩm" class="item_photo_new">
			<p class="item_title">Tana</p>
			<p class="item_sub_title">Kệ gỗ tự nhiên</p>
			<p class="honbun">Cảm thấy một không gian tự nhiên khi thấy gỗ ở trong nhà.</p>
		</div>

		<div class="clear"></div>

		<h2 class="title2">Sản phẩm nổi bật</h2>

		<div class="gray">
			<div class="photo">
				<img src="/img/cms/item4.png" alt="Ảnh sản phẩm" class="item_photo" />
			</div>
			<div class="osusume">
				<p class="item_title fc_yellow">Nakayoshi</p>
				<p class="item_sub_title fc_yellow">Thú bằng gỗ</p>
				<p class="honbun_osusume">Khỉ cũng là của yuppie và con mèo của trà.<br>Giá：1620¥</p>
			</div>

			<div class="clear"></div>
		</div>

		<div class="gray">
			<div class="photo">
				<img src="/img/cms/item5.png" alt="Ảnh sản phẩm" class="item_photo" />
			</div>
			<div class="osusume">
				<p class="item_title fc_yellow">Kinoko</p>
				<p class="item_sub_title fc_yellow">Nấm hương</p>
				<p class="honbun_osusume">Nó là một nấm hương thơm đầy màu sắc.<br>Giá：2100¥</p>
			</div>

			<div class="clear"></div>
		</div>

		<div class="gray">
			<div class="photo">
				<img src="/img/cms/item6.png" alt="Ảnh sản phẩm" class="item_photo" />
			</div>
			<div class="osusume">
				<p class="item_title fc_yellow">Te-pu</p>
				<p class="item_sub_title fc_yellow">Băng keo</p>
				<p class="honbun_osusume">Phổ biến cho mỗi chúng ta!<br>Giá：540¥</p>
			</div>

			<div class="clear"></div>
		</div>
	</div><!-- /main -->
</body>
</html>

EOM;
} elseif($lang == 'eng' || $lang == 'en') {
	$htmlDefault = <<<EOM

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>iPost</title>
	<link rel="stylesheet" type="text/css" href="/cms/css?userId=1" media="all" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes," />
</head>
<body>
	<div class="main">

		<img src="/img/cms/main.png" alt="Main photo" class="main_photo" />

		<h2 class="title">NEW</h2>

		<div class="new_item_box line_gray">
			<img src="/img/cms/item1.png" alt="Product photo" class="item_photo_new">
			<p class="item_title">Kirin</p>
			<p class="item_sub_title">Wood carving of giraffe</p>
			<p class="honbun">It is a wood carving of the doll that has been created by the hand of every single craftsman.</p>
		</div>

		<div class="new_item_box line_gray">
			<img src="/img/cms/item2.png" alt="Product photo" class="item_photo_new">
			<p class="item_title">Kotori</p>
			<p class="item_sub_title">Birds</p>
			<p class="honbun">The nest of birds using twigs, leaves has become a dried flower.</p>
		</div>

		<div class="new_item_box">
			<img src="/img/cms/item3.png" alt="Product photo" class="item_photo_new">
			<p class="item_title">Tana</p>
			<p class="item_sub_title">Natural shelf</p>
			<p class="honbun">The shade of the tree as it is, while staying in the house, it felt a natural.</p>
		</div>

		<div class="clear"></div>

		<h2 class="title2">Featured Products</h2>

		<div class="gray">
			<div class="photo">
				<img src="/img/cms/item4.png" alt="Product photo" class="item_photo" />
			</div>
			<div class="osusume">
				<p class="item_title fc_yellow">Nakayoshi</p>
				<p class="item_sub_title fc_yellow">Friends Animal</p>
				<p class="honbun_osusume">Monkey is also of yuppie and cats of tea.<br>Price：1620¥</p>
			</div>

			<div class="clear"></div>
		</div>

		<div class="gray">
			<div class="photo">
				<img src="/img/cms/item5.png" alt="Product photo" class="item_photo" />
			</div>
			<div class="osusume">
				<p class="item_title fc_yellow">Kinoko</p>
				<p class="item_sub_title fc_yellow">Aroma mushrooms</p>
				<p class="honbun_osusume">It is a colorful aroma mushrooms.<br>Price：2100¥</p>
			</div>

			<div class="clear"></div>
		</div>

		<div class="gray">
			<div class="photo">
				<img src="/img/cms/item6.png" alt="Product photo" class="item_photo" />
			</div>
			<div class="osusume">
				<p class="item_title fc_yellow">Te-pu</p>
				<p class="item_sub_title fc_yellow">Masking tape</p>
				<p class="honbun_osusume">Popular per we re-stock!<br>Price：540¥</p>
			</div>

			<div class="clear"></div>
		</div>
	</div><!-- /main -->
</body>
</html>

EOM;
} else {
	$htmlDefault = <<<EOM

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>iPost</title>
	<link rel="stylesheet" type="text/css" href="/cms/css?userId=1" media="all" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes," />
</head>
<body>
	<div class="main">

		<img src="/img/cms/main.png" alt="メイン写真" class="main_photo" />

		<h2 class="title">NEW</h2>

		<div class="new_item_box line_gray">
			<img src="/img/cms/item1.png" alt="商品写真" class="item_photo_new">
			<p class="item_title">Kirin</p>
			<p class="item_sub_title">木彫りのキリン</p>
			<p class="honbun">ひとつひとつ職人の手によって作り上げられた木彫りの人形です。</p>
		</div>

		<div class="new_item_box line_gray">
			<img src="/img/cms/item2.png" alt="商品写真" class="item_photo_new">
			<p class="item_title">Kotori</p>
			<p class="item_sub_title">小鳥たち</p>
			<p class="honbun">鳥の巣には小枝を使用し、葉はドライフラワーになっております。</p>
		</div>

		<div class="new_item_box">
			<img src="/img/cms/item3.png" alt="商品写真" class="item_photo_new">
			<p class="item_title">Tana</p>
			<p class="item_sub_title">ナチュラル棚</p>
			<p class="honbun">木の色合いをそのままに、家にいながらにして、自然を感じられます。</p>
		</div>

		<div class="clear"></div>

		<h2 class="title2">おすすめ商品</h2>

		<div class="gray">
			<div class="photo">
				<img src="/img/cms/item4.png" alt="商品写真" class="item_photo" />
			</div>
			<div class="osusume">
				<p class="item_title fc_yellow">Nakayoshi</p>
				<p class="item_sub_title fc_yellow">仲良しアニマル</p>
				<p class="honbun_osusume">サルのヤッピーとネコのちゃもです。<br>価格：1620円</p>
			</div>

			<div class="clear"></div>
		</div>

		<div class="gray">
			<div class="photo">
				<img src="/img/cms/item5.png" alt="商品写真" class="item_photo" />
			</div>
			<div class="osusume">
				<p class="item_title fc_yellow">Kinoko</p>
				<p class="item_sub_title fc_yellow">アロマきのこ</p>
				<p class="honbun_osusume">カラフルなアロマきのこです。<br>価格：2100円</p>
			</div>

			<div class="clear"></div>
		</div>

		<div class="gray">
			<div class="photo">
				<img src="/img/cms/item6.png" alt="商品写真" class="item_photo" />
			</div>
			<div class="osusume">
				<p class="item_title fc_yellow">Te-pu</p>
				<p class="item_sub_title fc_yellow">マスキングテープ</p>
				<p class="honbun_osusume">大人気につき再入荷いたしました！<br>価格：540円</p>
			</div>

			<div class="clear"></div>
		</div>
	</div><!-- /main -->
</body>
</html>

EOM;
}

