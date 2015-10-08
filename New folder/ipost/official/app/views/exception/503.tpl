{include "common/header.tpl"}


       <div id="title_wrap_error">
        <div id="title_bar_error"></div>
        <div id="title_box">
          <h2>Error</h2>
          <p id="title_sub">お探しのページが見つかりません。</p>
        </div>
      </div>

      <div class="content_box_error">
        <!--<div class="contents_box_head"></div>-->
        <h4>Error 503</h4>
        <p id="error_text">
          ご迷惑をお掛けしております。<br />処理中にエラーが発生しました。
          {if isset($message)}
          <br />
          {$message}
          {/if}
        </p>
        <a href="javascript:history.back();" class="goback_btn">一つ前へ戻る</a>
      </div>


{include "common/footer.tpl"}
