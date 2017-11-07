<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function getDomain()//도메인 반환
{
	return str_replace('index.php/', '', base_url());
}

function getJS($fileName)//js경로 생성
{	
	$js='';
	$num = rand();
	switch($fileName) {

		case 'regitView' :
			$js='<script src="'.getDomain().'js/board/regitView.js?ver='.$num.'"></script>';
		break;
	}

	return $js;
}

function showArray($array)//보기쉽게 배열 출력
{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function createList($object,$no='')//게시판 리스트 및 뷰 생성
{	
	$listForm='<table class="table table-hover">
	<thaed>
	<tr>
		<td>#</td>
		<td>제목</td>
		<td>작성자</td>
		<td>작성일</td>
	</tr>
	</thaed>
	<tbody>';
	if(!empty($object)){
		
		foreach($object as $list) {
			$listForm.='<tr>
				<td>'.$no--.'</td>
				<td>'.$list->title.'</td>
				<td>'.$list->adder.'</td>
				<td>'.$list->adddate.'</td>
			</tr>';
		}

	} else{

		$listForm.='<tr>
			<td colspan="4">등록된 글이 없습니다.</td>
		</tr>';

	}

	$listForm.="</tbody></table>";

	return $listForm;
}

function createForm($formName)//폼 생성
{
	$form='';
	switch($formName) {
		case 'boardRegit':
			$form.=form_open('test_c/boardRegit',array('id'=>$formName)).'
				제목: <input type="text" class="form-control" name="title" />
				<br>
				작성자: <input type="text" class="form-control" name="adder" />
				<br>
				내용:
				<textarea class="form-control" id="con" name="content">
				</textarea>
				<br>
				<div>
					<button type="button" class="btn btn-primary btn-lg" onclick="form_submit()">
					등록
					</button>
					<button type="button" class="btn btn-primary btn-lg" onclick="back()">
					뒤로
					</button>
				</div>
			'.form_close().'

			';
			break;
	}

	return $form;
}

function successMessage($msg,$url)//성공메세지 출력 및 이동
{
	echo "<meta http-equiv='Content-type' content='text/html; charset=utf-8'>
			<script>
				alert('".$msg."');
				
				location.href = '".base_url().$url."';
			</script>";
}

function errorMessage($msg)//에러메세지 출력
{
	echo "<meta http-equiv='Content-type' content='text/html; charset=utf-8'>
			<script>
				alert('".$msg."');
				history.back();
			</script>";
}