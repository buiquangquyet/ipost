{include "official/common/header.tpl"}

<div class="main">
  <div class="contact_form km">

    <p class="contact_title">お問い合わせフォーム</p>

    <form action="/contact/confirm" method="post">
      <table class="contact_tb">
        <tr>
          <th>住所<span class="red">※</span></th>
          <td>
            <select name="add" class="add" required>
                <option value="">都道府県の選択</option>
              <optgroup label="北海道・東北">  
                <option value="北海道">北海道</option>  
                <option value="青森県">青森県</option>  
                <option value="秋田県">秋田県</option>  
                <option value="岩手県">岩手県</option>  
                <option value="山形県">山形県</option>  
                <option value="宮城県">宮城県</option>  
                <option value="福島県">福島県</option>  
              </optgroup>  
              <optgroup label="甲信越・北陸">  
                <option value="山梨県">山梨県</option>  
                <option value="長野県">長野県</option>  
                <option value="新潟県">新潟県</option>  
                <option value="富山県">富山県</option>  
                <option value="石川県">石川県</option>  
                <option value="福井県">福井県</option>  
              </optgroup>  
              <optgroup label="関東">  
                <option value="茨城県">茨城県</option>  
                <option value="栃木県">栃木県</option>  
                <option value="群馬県">群馬県</option>  
                <option value="埼玉県">埼玉県</option>  
                <option value="千葉県">千葉県</option>  
                <option value="東京都">東京都</option>  
                <option value="神奈川県">神奈川県</option>  
              </optgroup>  
              <optgroup label="東海">  
                <option value="愛知県">愛知県</option>  
                <option value="静岡県">静岡県</option>  
                <option value="岐阜県">岐阜県</option>  
                <option value="三重県">三重県</option>  
              </optgroup>  
              <optgroup label="関西">  
                <option value="大阪府">大阪府</option>  
                <option value="兵庫県">兵庫県</option>  
                <option value="京都府">京都府</option>  
                <option value="滋賀県">滋賀県</option>  
                <option value="奈良県">奈良県</option>  
                <option value="和歌山県">和歌山県</option>  
              </optgroup>  
              <optgroup label="中国">  
                <option value="岡山県">岡山県</option>  
                <option value="広島県">広島県</option>  
                <option value="鳥取県">鳥取県</option>  
                <option value="島根県">島根県</option>  
                <option value="山口県">山口県</option>  
              </optgroup>  
              <optgroup label="四国">  
                <option value="徳島県">徳島県</option>  
                <option value="香川県">香川県</option>  
                <option value="愛媛県">愛媛県</option>  
                <option value="高知県">高知県</option>  
              </optgroup>  
              <optgroup label="九州・沖縄">  
                <option value="福岡県">福岡県</option>  
                <option value="佐賀県">佐賀県</option>  
                <option value="長崎県">長崎県</option>  
                <option value="熊本県">熊本県</option>  
                <option value="大分県">大分県</option>  
                <option value="宮崎県">宮崎県</option>  
                <option value="鹿児島県">鹿児島県</option>  
                <option value="沖縄県">沖縄県</option>  
              </optgroup>      
            </select>
          </td>
        </tr>
        <tr>
          <th>会社名・店名</th>
          <td><input type="text" name="shopname" class="form_area km"></td>
        </tr>
        <tr>
          <th>お名前<span class="red">※</span></th>
          <td><input type="text" name="username" class="form_area km" required></td>
        </tr>
        <tr>
          <th>メールアドレス<span class="red">※</span></th>
          <td>
            <input type="email" name="mail" class="form_area km" required><br />
            <p class="tb_p">例)sample@hiropro.co.jp</p>
            <input type="email" name="mail" class="form_area km" required><br />
            <p class="tb_p2">確認のためもう一度入力してください</p>
          </td>
        </tr>
        <tr>
          <th>お問い合わせ内容<span class="red">※</span></th>
          <td><textarea type="text" name="question" class="form_area km" rows="15" required></textarea></td>
        </tr>
      </table>

      <div class="check_btn_box">
        <p><input type="submit" value="確認画面へ" class="check_btn km"></p>
      </div>
    </form>

  </div>
</div>

<!-- フッター　-->
{include "official/common/footer.tpl"}
