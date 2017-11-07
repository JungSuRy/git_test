function form_submit()
{
	if($('input[name="title"]').val()==''){
		alert('제목을 입력해주세요.');
		return false;
	}

	if($('input[name="adder"]').val()==''){
		alert('작성자를 입력해주세요.');
		return false;
	}

	if($('#con').val()==''){
		alert('내용을 입력해주세요.');
		return false;
	}
}

function back()
{
	history.back();
}