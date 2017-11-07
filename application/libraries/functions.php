<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Functions {

	function __construct()
	{
		//parent::__construct();
		$this->CI =& get_instance();
		
	}

	function SetPagination($segment, $page_url, $total)//페이징 환경설정
	{
		$this->CI->load->helper('url');

		$page =  $this->CI->uri->segment($segment,1);

		$config['base_url'] = $page_url;
		$config['uri_segment'] = $segment;
		$config['total_rows'] = $total;
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['use_page_numbers'] =true;
		
		$this->CI->pagination->initialize($config);
		
		$page = isset($page) && is_numeric($page)?$page:1;
		
		$data['pagination'] = $this->CI->pagination->create_links();
		$data['start'] =  ($page-1)*$config['per_page'];
		$data['limit'] =  $config['per_page'];

		return $data;
	}

	function getData()
	{
		$data = array();

		foreach($this->CI->input->get(null, true) as $key => $val) $data["{$key}"]= $val;

		return $data;
	}

	function postData()
	{
		$data = array();

		foreach($this->CI->input->post(null, true) as $key => $val) $data["{$key}"]= $val;

		return $data;
	}
}