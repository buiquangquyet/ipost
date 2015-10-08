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
        <h4>Error 409</h4>
        <p id="error_text">
          既にアプリ審査申請済みです。<br />
          只今審査中ですので審査完了まで暫くお待ちください。
          {if isset($message)}
          <br />
          {$message}
          {/if}
        </p>
        <a href="javascript:history.back();" class="goback_btn">一つ前へ戻る</a>
      </div>


{include "common/footer.tpl"}
