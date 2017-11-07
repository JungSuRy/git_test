<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board_m extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}

	function getBoardList($type='', $start='', $limit='')
	{

		$limit_query = '';
		
		if($start !='' || $limit !='') {

			$limit_query = ' limit '.$start.', '.$limit;
		}

		$sql = 'select * from SH_BOARD'.$limit_query;
	
		$query = $this->db->query($sql);

		if($type == 'count') {

			$result =  $query->num_rows();

		} else {

			$result = $query->result();
		}

		return $result;
	}

	function regitBoard($data)
	{
		$sql = 'insert into SH_BOARD(title, context, adddate, adder) values(?,?,?,?)';

		$result = $this->db->query($sql, array($data['title'], $data['content'], date('Y-m-d H:i:s'), $data['adder']));
		return $result;
	}
}