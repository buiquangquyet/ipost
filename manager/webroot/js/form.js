
/**
* 対象のIDのフォームの表示、非表示を行います。
* prefixとして、dispが表示されている内容、formがフォームの内容となります。
*/
function toggleForm(targetId) {
	$('#disp_' + targetId).toggle('fast');
	$('#form_' + targetId).toggle('fast');
}