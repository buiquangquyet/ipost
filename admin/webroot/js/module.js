// angularJSの設定
moduleBase = angular.module('moduleBase', []);

// サービスの実装
// 対象のURLにアクセスして、情報を取得します
moduleBase.service('AjaxUrlAccess', ['$http', function($http){
	// 対象のURLにアクセスして、JSON形式で情報を取得します。
	this.getJsonInfo = function(url){
		console.log('URL::' + url);

		// 情報を取得します。
		resultObject = { disp:{}, form:{}};
		console.log(resultObject);

		$http.get(url)
		.success(function success(data, status, headers, config){

			// 成功
			console.log('成功::' + url);
			console.log(data);
			angular.extend(resultObject['disp'], data);
			angular.extend(resultObject['form'], data);

		}).error(function error(data, status, headers, config){
			// 失敗
			console.log('失敗::' + url);
			console.log(data);

		});

		return resultObject;
	}

	// 情報をPOSTします。
	// 引数で指定したformIdのFormの中身を全部POSTします。
	this.postData = function(formId, callback){
		console.log('PostFormId::' + formId);

		// 情報をPOSTする。まずはPOSTする情報の一覧をオブジェクトへ変換
		form = $(formId);
		formData = new FormData(form[0]);
		console.log('formData');
		console.log(formData);

		//POST先URLを取得する
		postUrl = $(formId).attr('action');
		console.log('POSTURL::' + postUrl);

		// 返却用情報ポインタの生成
		resultObject = {};
		errorObject = {};
		returnObject = {"result":resultObject, "error":errorObject};

		// POSTする。		
		$http.post(postUrl, formData, {
			headers:{"Content-type":undefined}
		    ,transformRequest: null
		}).success(
			function success(data, status, headers, config){

				// POSTは成功した。jsonのデータ返却する
				// console.log('PostResultData');
				console.log(data);
				// console.log(data.code);

				// 結果を確認。バリデーション失敗なら、コールバック実行する。
				if (data.code == 2) {
					// 情報を流し込む
					angular.extend(returnObject.error, data);
				} else {
					// 情報を流し込む
					angular.extend(returnObject.result, data);
					eval(callback);
				}
			}
		).error(
			function error(data, status, headers, config){

				// なんか失敗したので、エラーが発生したことをjsonにして戻す。
				// console.log('PostResultDataError');
				console.log(data);
				// console.log(status);
				// console.log(headers);
				// console.log(config);

				//　未実装
			}
		);

		// ポインタのみ返却
		return returnObject;
	}
}]);

/**
* フォームを操作する関数をangularから使えるように。。実際の操作内容はform.jsに記述されている。
*/
moduleBase.service('FormOperator', [function(){
	// 対象のURLにアクセスして、JSON形式で情報を取得します。
	this.ngToggleForm = function(id){
		toggleForm(id);
	}
}]);

// ファイルアップロードのディレクティブを設定する
moduleBase.directive('fileUpload', ['AjaxUrlAccess', function(AjaxUrlAccess) {
	return {
		link : function(scope, element, attrs) {
			//elementはDOMではなく, jQueryオブジェクトです.
			element.on('change', function(event) {
				// IDを取得してファイルのアップロードを起動
				targetId = event.target.getAttribute('targetId');
				console.log('対象ID::' + targetId);

				// POSTする
				AjaxUrlAccess.postData(targetId);
			});
		}
	};
}]);