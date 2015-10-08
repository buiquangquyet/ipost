{include "common/header.tpl"}


       <div id="title_wrap_error">
        <div id="title_bar_error"></div>
        <div id="title_box">
          <h2>アプリ公開中のみ利用できるサービスです</h2>
          <p id="title_sub"></p>
        </div>
      </div>

      <div class="content_box_error">
        <!--<div class="contents_box_head"></div>-->
        <h4>Error 411</h4>
        <p id="error_text">
          本機能はアプリ公開中のみ利用できるサービスです。
          {if isset($message)}
          <br />
          {$message}
          {/if}
        </p>
        <a href="javascript:history.back();" class="goback_btn">一つ前へ戻る</a>
      </div>


{include "common/footer.tpl"}
