// JavaScript Document
$(function() {
	$('dl.accordion>dd').hide();
	$('dl.accordion>dt.opened').nextUntil('dl.accordion>dt').show('first');
	$('dl.accordion>dt').click(function(e) {
		$('dl.accordion>dt').not(this).removeClass('opened');
		$(this).toggleClass('opened');
		$('dl.accordion>dt').not(this).nextUntil('dl.accordion>dt').hide('first');
		$(this).nextUntil('dl.accordion>dt').toggle('first');
	});
});