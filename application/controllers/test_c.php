<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_c extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model('board_m');
		$this->load->library('pagination');
	}

	public function _remap($method, $params)
	{
		$this->load->view('common/html_head');
		
		if(method_exists($this, $method)) {
			
			$this->{"{$method}"}($params) ;

		}
		
		$data['js'] = '';
		
		/*
			params[0]='js파일명으로'

		*/

		if(count($params) != 0 && $params[0] !='e'){

			$data['js'] = getJS($params[0]);
		}

		$this->load->view('common/html_footer',$data);
	}

	function showList($params)
	{

		$segment = 5;
		
		$totalPage = $this->board_m->getBoardList('count','','');
		
		$url = base_url().'test_c/showList/e/p';

		$data = $this->functions->SetPagination($segment,$url,$totalPage);
		
		$result = $this->board_m->getBoardList('',$data['start'], $data['limit']);

		@$no =  $totalPage-($data['start']/count($result)*count($result));
		
		$data['list'] = createList($result, $no);

		$this->load->view('board/boardlist_v', $data);
		

	}

	function regitView()
	{
		$data['form'] = createForm('boardRegit');
		$this->load->view('board/regitView_v',$data);
	}

	function boardRegit()
	{
		$data = $this->functions->postData();

		$result =  $this->board_m->regitBoard($data);

		if($result) {

			successMessage('글이 등록되었습니다.', 'test_c/showList');

		} else {

			errorMessage('글등록에 문제가 생겼습니다.');

		}

	}

}
