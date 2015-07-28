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

class bbcode2html_class extends AWS_MODEL
{
	
	
	public function get_all($table)
	{
		return $this->fetch_all($table);
	}
	
	
	public function get_article_info_by_id($article_id)
	{
		if (!is_digits($article_id))
		{
			return false;
		}

		static $articles;

		if (!$articles[$article_id])
		{
			$articles[$article_id] = $this->fetch_row('article', 'id = ' . $article_id);
		}

		return $articles[$article_id];
	}
	
	public function get_question_info_by_id($question_id)
	{
		if (!is_digits($question_id))
		{
			return false;
		}

		static $questions;

		if (!$questions[$question_id])
		{
			$question[$question_id] = $this->fetch_row('question', 'question_id = ' . $question_id);
		}

		return $questions[$question_id];
	}
	
	public function change_article($id,$data)
	{
		//var_dump($data);
		return $this->update('article', array(
			'message' => $data
		), 'id = ' . intval($id));
	}
	
	public function change_question($id,$data)
	{
		//var_dump($data);
		return $this->update('question', array(
			'question_detail' => $data
		), 'question_id = ' . intval($id));
	}
}