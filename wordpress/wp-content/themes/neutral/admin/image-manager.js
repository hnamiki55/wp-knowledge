jQuery(document).ready(function($){
	//Drag resizing
	if($('#neutral-logo-adjuster').length > 0){
		var resizeRatio = $('#neutral-logo-adjuster').attr('class').split('-');
		resizeRatio = resizeRatio[2] / resizeRatio[1];
		$('#neutral-logo-adjuster img').draggable({
			containment: 'parent',
			drag: function(){
				var top = Math.round(parseInt($(this).css('top'), 10) / resizeRatio);
				var left = Math.round(parseInt($(this).css('left'), 10) / resizeRatio);
				$('#dp-options-logotop').val(top);
				$('#dp-options-logoleft').val(left);
			}
		});
		$('#dp-adjust-realvalue').click(function(e){
			e.preventDefault();
			var top = Math.round(parseInt($('#dp-options-logotop').val(), 10) * resizeRatio);
			var left = Math.round(parseInt($('#dp-options-logoleft').val(), 10) * resizeRatio);
			$('#neutral-logo-adjuster img').css({
				top: top + 'px',
				left: left + 'px'
			});
		});
		var dpResizeValueDisplay = function(){
			var percent = parseInt($('#dp_resize_ratio').val(), 10);
			if(isNaN(percent)){
				percent = 100;
			}
			var originalToDisplayRatio = percent / 100 / parseFloat($('input[name=dp_logo_to_resize_ratio]').val());
			$('#dp_resized_height').val(Math.round(parseInt($('input[name=dp_logo_resize_height]').val(), 10) * originalToDisplayRatio));
			$('#dp_resized_width').val(Math.round(parseInt($('input[name=dp_logo_resize_width]').val(), 10) * originalToDisplayRatio));
		};
		$('#dp_logo_to_resize').imgAreaSelect({
			handles: true,
			onSelectChange: function(img, selection){
				$('input[name=dp_logo_resize_height]').val(selection.height);
				$('input[name=dp_logo_resize_width]').val(selection.width);
				$('input[name=dp_logo_resize_left]').val(selection.x1);
				$('input[name=dp_logo_resize_top]').val(selection.y1);
				dpResizeValueDisplay();
			}
		});
		$('#dp_resize_ratio').blur(function(e){
			var percent = parseInt($(this).val(), 10);
			if(isNaN(percent) || percent > 100){
				$(this).val(100);
			}
			dpResizeValueDisplay();
		});
		$('#dp-resize-canceler').click(function(e){
			e.preventDefault();
			$('input[name=dp_logo_resize_left]').val('');
			$('input[name=dp_logo_resize_top]').val('');
			$('#dp_resized_height').val('');
			$('#dp_resized_width').val('');
		});
	}
});