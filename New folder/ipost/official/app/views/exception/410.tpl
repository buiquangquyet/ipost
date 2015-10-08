{include "common/header.tpl"}


       <div id="title_wrap_error">
        <div id="title_bar_error"></div>
        <div id="title_box">
          <h2>アプリ審査中</h2>
          <p id="title_sub"></p>
        </div>
      </div>

      <div class="content_box_error">
        <!--<div class="contents_box_head"></div>-->
        <h4>Error 410</h4>
        <p id="error_text">
          現在、アプリ審査中です。<br />
          アプリ審査中はコンテンツの更新はできません。<br />
          アプリ審査終了後にコンテンツの更新ができるようになります。<br />
          審査終了まで暫くお待ちください。
          {if isset($message)}
          <br />
          {$message}
          {/if}
        </p>
        <a href="javascript:history.back();" class="goback_btn">一つ前へ戻る</a>
      </div>


{include "common/footer.tpl"}
