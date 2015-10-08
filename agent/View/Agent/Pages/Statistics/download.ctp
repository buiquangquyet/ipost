<div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('ダウンロード数一覧'); ?></div>
  <h2><i class="fa fa-bar-chart">&nbsp;</i><?php echo __('統計表示'); ?><span>｜<?php echo __('アプリケーション'); ?></span></h2>

  <h3><?php echo __('ダウンロード数一覧'); ?></h3>

  <div>
    <fieldset>
      <table id="client" border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="10" class="list">
        <thead>
          <tr>
            <th><?php echo __('クライアントID'); ?></th>
            <th><?php echo __('クライアント名'); ?></th>
            <th><?php echo __('アプリ名'); ?></th>
            <th><?php echo __('ダウンロード数'); ?></th>
          </tr>
        </thead>

        <tbody>
<?php foreach ((array)$list as $user) : ?>
          <tr>
            <td><span class="num"><?php echo $user['User']['id']; ?></span></td>
            <td><?php echo $user['User']['user_name']; ?></td>
            <td><?php echo $user['app_name']; ?></td>
            <td><?php echo $user['count']; ?></td>
          </tr>
<?php endforeach; ?>
        </tbody>

      </table>
    </fieldset>
  </div>

<script type="text/javascript">
$(function(){
  var tr = $("table#agent tbody tr");
  var sum = 0;
  for( var i=0,l=tr.length;i<l;i++ ){
  var cells = tr.eq(i).children();
  sum += Number(cells.eq(1).text());
  }
  $('table#agent tbody tr td.sum').text(sum);
});
$(function(){
  var tr = $("table#client tbody tr");
  var sum = 0;
  for( var i=0,l=tr.length;i<l;i++ ){
  var cells = tr.eq(i).children();
  sum += Number(cells.eq(1).text());
  }
  $('table#client tbody tr td.sum').text(sum);
});
</script>
