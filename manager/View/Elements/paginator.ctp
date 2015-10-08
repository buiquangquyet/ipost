<?php if ($this->params['paging'][$model]['pageCount'] > 1) { ?>

<?php 
// GETパラメータを追加する　検索窓以外のところからGETパラメータ追加した時とかに使ってください。
if (!empty($queryString)) {
	$this->Paginator->options(
		array('url' => array('?' => $queryString))
	);
}
?>
<div class="row">
	<div class="col-md-12">
		<ul class="pagination">
			<?php echo $this->Paginator->prev(__('＜＜'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
			<?php echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1, 'ellipsis' => '<li class="disabled"><a>...</a></li>')); ?>
			<?php echo $this->Paginator->next(__('＞＞'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
		</ul>
	</div>
</div>
<?php } ?>
<?php echo $this->Paginator->counter(array('format' => __('全{:count}件中　{:page}/{:pages}ページを表示'))); ?>