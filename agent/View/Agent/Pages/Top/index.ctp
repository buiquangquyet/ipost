<div class="main root">
  <div class="main_title"><a href="/"><?php echo __('HOME'); ?></a></div>
  <h2><i class="fa fa-home">&nbsp;</i><?php echo __('HOME'); ?></h2>

  <h3><i class="fa fa-user">&nbsp;</i><?php echo __('ユーザー管理'); ?></h3>
  <fieldset>
    <fieldset>
      <legend><i class="fa fa-paperclip">&nbsp;</i><?php echo __('クライアント管理'); ?></legend>
      <ul>
        <li><a href="/client/list"><?php echo __('アカウント一覧'); ?></a></li>
        <li><a href="/client/add"><?php echo __('アカウント新規登録'); ?></a></li>
      </ul>
    </fieldset>
  </fieldset>

  <h3><i class="fa fa-bar-chart">&nbsp;</i><?php echo __('統計表示'); ?></h3>
  <fieldset>
    <fieldset class="mt_20">
      <legend><i class="fa fa-mobile">&nbsp;</i><?php echo __('アプリケーション'); ?></legend>
      <ul>
        <li><a href="/statistics/appli"><?php echo __('アプリ公開数'); ?></a></li>
        <li><a href="/statistics/download"><?php echo __('ダウンロード数一覧'); ?></a></li>
      </ul>
    </fieldset>
  </fieldset>

  <h3><i class="fa fa-file-text">&nbsp;</i><?php echo __('審査申請'); ?></h3>
  <fieldset>
    <ul>
      <li><a href="/inspect/list">審査申請アプリ一覧</a></li>
    </ul>
  </fieldset>

  <h3><i class="fa fa-building">&nbsp;</i><?php echo __('代理店管理'); ?></h3>
  <fieldset>
    <ul>
      <li><a href="/agent/info"><?php echo __('代理店情報'); ?></a></li>
    </ul>
  </fieldset>

  <!-- Countries -->
  <h3><i class="fa fa-life-ring">&nbsp;</i><?php echo __('国'); ?></h3>
  <fieldset>
    <fieldset>
      <legend><i class="fa fa-chain-broken">&nbsp;</i><?php echo __('国管理'); ?></legend>
      <ul>
        <li><a href="/country"><?php echo __('国の一覧'); ?></a></li>
        <li><a href="/country/add"><?php echo __('新規国の登録'); ?></a></li>
      </ul>
    </fieldset>
  </fieldset>

  <!-- Cities
  <h3><i class="fa fa-star">&nbsp;</i><?php echo __('シティ'); ?></h3>
  <fieldset>
    <fieldset>
      <legend><i class="fa fa-star-o">&nbsp;</i><?php echo __('都市の管理'); ?></legend>
      <ul>
        <li><a href="/city"><?php echo __('都市の一覧'); ?></a></li>
        <li><a href="/city/add"><?php echo __('新規都市の登録'); ?></a></li>
      </ul>
    </fieldset>
  </fieldset>-->
</div>
