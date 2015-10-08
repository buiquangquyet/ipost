<div id="shopInfo" class="main">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a>&nbsp;>&nbsp;<?php echo __('アプリ公開数'); ?></div>
  <h2><i class="fa fa-bar-chart">&nbsp;</i><?php echo __('統計表示'); ?><span>｜<?php echo __('アプリケーション'); ?></span></h2>

  <h3><?php echo __('アプリ公開数'); ?></h3>

  <fieldset>

    <p><?php echo $publishCnt; ?>&nbsp;<?php echo __('種類'); ?></p>
  </fieldset>

  <h3><?php echo __('アプリダウンロード数'); ?></h3>
  <fieldset>
    <p><?php echo $deviceCnt; ?>&nbsp;<?php echo __('ダウンロード'); ?></p>
  </fieldset>

</div>

