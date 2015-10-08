{include "official/common/header.tpl"}

<div class="main">
  <div class="contact_form km">

    <p class="contact_title">お問い合わせフォーム</p>

    <form action="/contact/exe" method="post">

      <input type='hidden' name='pref' value="{$input_contents['pref']}">
      <input type='hidden' name='shopname' value="{$input_contents['shop_name']}">
      <input type='hidden' name='username' value="{$input_contents['user_name']}">
      <input type='hidden' name='mail' value="{$input_contents['mail']}">
      <input type='hidden' name='question' value="{$input_contents['question']}">

      <table class="contact_tb">
        <tr>
          <th>住所</th>
          <td>{$input_contents['pref']}</td>
        </tr>
        <tr>
          <th>会社名・店名</th>
          <td>{$input_contents['shop_name']}</td>
        </tr>
        <tr>
          <th>お名前</th>
          <td>{$input_contents['user_name']}</td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td>{$input_contents['mail']}</td>
        </tr>
        <tr>
          <th>お問い合わせ内容</th>
          <td>{$input_contents['question']|nl2br}</td>
        </tr>
      </table>

      <div class="btn">
        <input type="button" value="戻　る" onClick="history.back()" class="check_btn km back_btn">
        <input type="submit" value="送信する" class="check_btn km back_btn">

        <div class="clear"></div>
      </div>
    </form>

  </div>
</div>

<!-- フッター　-->
{include "official/common/footer.tpl"}
