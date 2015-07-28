<?php
/*
+--------------------------------------------------------------------------
|   WeCenter [#RELEASE_VERSION#]
|   ========================================
|   by WeCenter Software
|   © 2011 - 2014 WeCenter. All Rights Reserved
|   http://www.wecenter.com
|   ========================================
|   Support: WeCenter@qq.com
|
+---------------------------------------------------------------------------
*/


if (!defined('IN_ANWSION'))
{
	die;
}

class main extends AWS_CONTROLLER
{
	public function get_access_rule()
	{
		$rule_action['rule_type'] = 'white';

		if ($this->user_info['permission']['visit_question'] AND $this->user_info['permission']['visit_site'])
		{
			$rule_action['actions'][] = 'square';
			$rule_action['actions'][] = 'index';
		}

		return $rule_action;
	}
	
	//问答转换
	public function index_action()
	{
		if($_GET['id']==1)
		{
			$data=$this->model('bbcode2html')->get_all('question');
			$i=0;
			foreach($data as $key => $val)
			{
				$result1=k('[li',$val['question_detail']);
				$result2=k('[attach',$val['question_detail']);
				$result3=k('[b]',$val['question_detail']);
				$result4=k('[i]',$val['question_detail']);
							
				if($result1==true or $result2==true or $result3==true or $result4==true )
				{
					$id=$val['question_id'];
					//$question_info = $this->model('bbcode2html')->get_question_info_by_id($id);
					if ($val['has_attach'])
					{
						$val['attachs'] = $this->model('publish')->get_attach('question', $id, 'min');							
					}
					
					$old=FORMAT::parse_attachs(nl2br(FORMAT::parse_bbcode($val['question_detail'])));
					
					$re=$this->model('bbcode2html')->change_question($id,htmlspecialchars($old));
					if($re)
					{
						$i++;
					}
					
				}
			}
		}
		var_dump($i);	
		TPL::output('bbcode2html/index');
	}
	
	//文章转换
	public function index_square_action()
	{
		$data=$this->model('bbcode2html')->get_all('article');
		$i=0;
		foreach($data as $key => $val)
		{
			$result1=k('[size',$val['message']);
			$result2=k('[attach',$val['message']);
			$result3=k('[b]',$val['message']);
			
			if($result1==true or $result2==true or $result3==true )
			{
				$id=$val['id'];
				//$article_info = $this->model('bbcode2html')->get_article_info_by_id($id);
				if ($val['has_attach'])
				{
					$val['attachs'] = $this->model('publish')->get_attach('article', $id, 'min');							
				}
		
				//$article_info['user_info'] = $this->model('account')->get_user_info_by_uid($article_info['uid'], true);

				$old=FORMAT::parse_attachs(nl2br(FORMAT::parse_bbcode($val['message'])));

				$re=$this->model('bbcode2html')->change_article($id,htmlspecialchars($old));
				if($re)
				{
					$i++;
				}
				

			}

		

		}
		var_dump($i);
		TPL::output('bbcode2html/square');
	}
}
