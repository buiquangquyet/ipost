<?php 
$cssDefault = <<<EOM

/*-------------------------------------------------------------------------------****リセット
*****-------------------------------------------------------------------------------*/
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
     margin: 0;
     padding: 0;
     border: 0;
     outline: 0;
     font-size: 100%;
     vertical-align: baseline;
     background: transparent;
}
body {
     line-height: 1;
}
ol, ul {
     list-style: none;
}
blockquote, q {
     quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
     content: '';
     content: none;
}

/* remember to define focus styles! */
:focus {
     outline: 0;
}

/* remember to highlight inserts somehow! */
ins {
     text-decoration: none;
}
del {
     text-decoration: line-through;
}

/* tables still need 'cellspacing="0"' in the markup */
table {
     border-collapse: collapse;
     border-spacing: 0;
}


/*-----------------------------------  使い回すcss ------------------------------------*/
.clear{
	clear:both;
}
.km{
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	-ms-border-radius:5px;
	-o-border-radius:5px;
}
.main{
	width:100%;
}
/*------------------------------------------------------------------------------------------*/
body{
	background: white;
	font-family: "メイリオ", Meiryo, "Hiragino Kaku Gothic Pro", "ヒラギノ角ゴ Pro W3", "Ｍ
Ｓ Ｐゴシック", "Lucida Grande", "Lucida Sans Unicode", Arial, Verdana, sans-serif;
	color:#666;
	letter-spacing:0.03em;
	width:100%;
}
a:link{    
     text-decoration:none; /*-- 未訪問のリンク --*/
     color:#666;
	 cursor:pointer;
}
a:visited{
     color: white;  /*-- 訪問済みのリンク --*/
}
a:active {
     text-decoration:none; /*-- 選択中のリンク --*/
}
/*------------------------------------------------------------------------------------------*/
.main_photo{
	width:100%;
}
.title{
	padding-bottom:3%;
	padding-top:3%;
	background-color:#54b0bb;
	color:white;
	margin-top:-3px;
	padding-left:3%;
}
.new_item_box{
	width: 33.1%;
	float: left;
	min-height:180px;
}
.line_gray{
	border-right: 1px solid #D5D5D5;
}
.item_photo_new{
	width:100%;
}
.item_title{
	color:#54b0bb;
	font-weight:bold;
	font-size:16px;
	margin-top:3%;
	margin-bottom:3%;
	padding-left:5%;
}
.item_sub_title{
	color:#54b0bb;
	font-size:11px;
	margin-bottom:3%;
	padding-left:5%;
}
	
.honbun{
	font-size:10px;
	padding-left:5%;
	padding-right:5%;
	line-height:1.5;
	margin-bottom:5%;
	min-height:60px;
}

.title2{
	padding-bottom:3%;
	padding-top:3%;
	background-color:#e1c743;
	color:white;
	padding-left:3%;
}
.fc_yellow{
	color:#e1c743;
	margin-bottom:2%;
}
.photo{
	float:left;
	width:33.1%;
}
.osusume{
	float:left;
	width:66.9%;
}
.item_photo{
	width:100%;
	margin-bottom:-3px;
}
.honbun_osusume{
	font-size:10px;
	padding-left:5%;
	padding-right:5%;
	line-height:1.5;
}
.gray{
	border-bottom: 1px solid #D5D5D5;
}

EOM;
