<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

class Select extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('text_light');
		$this->load->helper('url');
	}

	/**
	 * 首页查询
	 */
	public function index($page = '1')
	{
		$type = $this->input->post('seltype');
		$value = $this->input->post('selvalue');
		$tab = $this->input->post('tab');

		if(!$type)
		{
			$sesson_sel = $this->session->userdata('select');
			$type = $sesson_sel['type'];
			$value = $sesson_sel['value'];
			$tab = $sesson_sel['tab'];
		}
		if(!$tab || $tab=='')
		{
			$tab = 'contact';
		}
		/*if($value=='请输入关键词')
		{
			redirect($this->config->base_url().'index.php');
		}
		else
		{*/
			$data = array(
				'type'	=> $type,
				'value'	=> $value,
				'tab'	=> $tab,
				'is_login'=>$this->session->userdata('user_id'),
			);
			$this->load->view('welcome/select_header',$data);

			$this->session->set_userdata(array('select'=>$data));

			if($value=='请输入关键词')$value = '';
			switch($type)
			{
				case 'news':
					$re = $this->sel_news($value,$page);
					$this->load->view('welcome/select_news',$re);
					break;
				case 'contact':
					$re = $this->sel_contact($value,$page);
					$this->load->view('welcome/select_contact_1',$re);
					break;
				case 'plan':
//					$re = $this->sel_contact($value,$page);
					$re = $this->sel_plan($value,$page);
					$this->load->view('welcome/select_plan',$re);
					break;
				default:
					switch($tab)
					{
						case 'news':
							$re = $this->sel_news($value,$page);
							break;
						default:
							$re = $this->sel_contact($value,$page);
							$tab = 'contact';
							break;
					}
					$re['tab'] = $tab;
					$this->load->view('welcome/select_all_1',$re);
					break;
			}
			$this->load->view('welcome/select_footer');
		//}
	}

	/**
	 * 查询联系人
	 */
	function sel_contact($value,$page='1',$pageSize='20')
	{
		//---------企业类型--------------
		$this->load->model('m_contact_total');
		$type = $this->m_contact_total->get_field(false,'t_company_type',array('name like'=>'%'.$value.'%'));
		$allType = $this->m_contact_total->get_field(false,'t_company_type');
		$hashType = array();
		if(is_array($allType))
		{
			foreach($allType as $v)
			{
				$hashType[$v['id']] = $v['name'];
			}
		}

		$arrTypes = array();
		foreach($type as $v)
		{
			$arrTypes[] =$v['id'];
		}
		//---------企业类型--------------

		$this->load->model('m_contact_select');

		$num = $this->m_contact_select->contact_num($value,$arrTypes);

		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;

		$pageinfo = $this->pages($num,$pageSize);

		$list = $this->m_contact_select->contact_select($value,$arrTypes,($page-1)*$pageSize,$pageSize);
		if(is_array($list))
		{
			foreach($list as $k => $v)
			{
				$tmp = explode('.',trim($v->detail,'.'));
				$str = "";
				if(is_array($tmp)){
					foreach($tmp as $t)
					{
						$str .= isset($hashType[$t])?($hashType[$t].' > '):'';
					}
				}
				$v->typename = trim($str,' > ');
				if($value!='')
				{
					$v->u_name = $this->text_light->light($v->u_name,$value);
					$v->c_name = $this->text_light->light($v->c_name,$value);
					$v->position = $this->text_light->light($v->position,$value);
					$v->typename = $this->text_light->light($v->typename,$value);
				}
				$list[$k] = $v;
			}
		}

		$data = array(
					'list'	=> $list,
					'pages'	=> $pageinfo,
				);
		return $data;
	}

	/**
	 * 查询News Letter
	 */
	function sel_news($value,$page='1',$pageSize='20')
	{
		$this->load->model('m_news_select');

		$num = $this->m_news_select->news_num($value);

		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;

		$pageinfo = $this->pages($num,$pageSize);

		$list = $this->m_news_select->news_select($value,($page-1)*$pageSize,$pageSize);
		if(is_array($list))
		{
			foreach($list as $k => $v)
			{
				if($value!='')
				{
					$v->tname = $this->text_light->light($v->tname,$value);
					$v->info = $this->text_light->light($v->info,$value);
					$v->ndate = substr($v->ndate,0,10);
					$v->ndate = $this->text_light->light($v->ndate,$value);
				}
				$list[$k] = $v;
			}
		}

		$data = array(
			'list'	=> $list,
			'pages'	=> $pageinfo,
		);
		return $data;
	}

	function sel_plan($value,$page='1',$pageSize='20'){
		$this->load->model('m_plan');
		$num = $this->m_plan->get_plan_num($value);
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;

		$pageinfo = $this->pages($num,$pageSize);
		$list = $this->m_plan->plan_select($value,($page-1)*$pageSize,$pageSize);
		$data = array(
			'list'	=> $list,
			'pages'	=> $pageinfo,
		);
		return $data;

	}



	/**
	 * 分页
	 */
	function pages($num,$pageSize)
	{
		$this->load->library('pagination');

		$config['base_url'] = '/index.php/select/index/';
		$config['total_rows'] = $num;
		$config['per_page'] = $pageSize;

		$this->pagination->initialize($config);

		return $this->pagination->create_links();
	}


	/**
	 * 点击NewsLetter进入日历页
	 */
	public function newsletter()
	{
		$data = array(
			'type'	=> 'all',
			'value'	=> '',
			'tab'	=> '',
			'is_login'=>$this->session->userdata('user_id'),
		);
		$this->load->view('welcome/select_header',$data);
		$this->load->view('welcome/calendar');
		$this->load->view('welcome/select_footer');
	}
	/**
	 * 新闻日历表内容
	 */
	public function calendar_data()
	{
		$this->load->model('m_news_type');
		$this->load->model('m_news');

		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$arr = explode('-', $end);
		$end_tmp = mktime(0,0,0,$arr[1],$arr[2],$arr[0])-86400;
		$end = date('Y-m-d',$end_tmp);

		//类型名称hash
		$types = $this->m_news_type->news_type_hash();

		//获取各日期的新闻类型
		$re = $this->m_news->calendar_info($start,$end);
		$data = array();
		if(is_array($re))
		{
			foreach($re as $val)
			{
				if(empty($data[$val->tdate]))
				{
					$data[$val->tdate] = $types[$val->ntype]."[".$val->num."]";
				}
				else
				{
					$data[$val->tdate] .= "\n".$types[$val->ntype]."[".$val->num."]";
				}
			}
		}

		echo json_encode($data);
		/*
		if(is_array($re))
		{
			foreach($re as $key => $val)
			{
				$re[$key]->title = $types[$val->ntype].'['.$val->num.']';
			}
		}

		echo json_encode($re);
		*/
	}

	/**
	 * 点击NewsLetter进入日历页
	 */
	public function newsview()
	{
		$data = array(
			'type'	=> 'all',
			'value'	=> '',
			'tab'	=> '',
			'is_login'=>$this->session->userdata('user_id'),
		);
		$this->load->view('welcome/select_header',$data);


		$date = $this->input->post('date');
		if($date=='')
		{
			$date = date('Y-m-d');
		}

		$idata = array(
			'date'		=> $date,
		);

		$this->load->model('m_news');
		$type_publish = $this->m_news->get_publish($date);

		if(count($type_publish)>0)
		{
			$type_publish = $type_publish[0];
			$type = explode(',',$type_publish->info);

			$this->load->model('m_news_type');

			if(count($type)==0)
			{
				$idata['info'] = '';
			}
			else
			{
				//获取新闻内容
				$where = array(
					'start' => $date,
					'end'	=> $date,
					'ids'	=> $type,
					'state'	=> '1'
				);
				$re = $this->m_news->news_list($where);

				if(count($re)==0)
				{
					$idata['info'] = '';
				}
				else
				{
					//将新闻按类型分组，并获取有效类型ID
					$news = array();
					if(is_array($re))
					{
						foreach($re as $val)
						{
							$news[$val->ntype][] = $val;
						}
					}
					//新闻ID->名称
					$type_info = $this->m_news_type->news_type_list();
					$type_hash = array();
					$type_detail = array();
					if(is_array($type_info))
					{
						foreach($type_info as $v)
						{
							$arr = explode('.',$v->detail);
							switch(count($arr))
							{
								case 1:	$type_hash[$v->id] = '【'.$v->name.'】';	break;
								case 2:	$type_hash[$v->id] = '*'.$v->name.'*';	break;
								default:$type_hash[$v->id] = $v->name;			break;
							}
							$type_detail[$v->id] = $arr;
						}
					}
					//拼新闻内容
					$idata['info'] = '';
					$type_used = array();
					if(is_array($type))
					{
						foreach($type as $t)
						{
							if(empty($news[$t]))
							{
								continue;
							}
							$detail = $type_detail[$t];
							if(is_array($detail))
							{
								foreach($detail as $d)
								{
									if(!in_array($d,$type_used))
									{
										$type_used[] = $d;
										$idata['info'] .= '<p><strong>'.$type_hash[$d].'</strong></p>';
									}
								}
							}
							if(isset($news[$t]) && is_array($news[$t]))
							{
								foreach($news[$t] as $val)
								{
									$idata['info'] .= $val->info;
								}
							}
						}
					}
				}
			}
		}
		else
		{
			$idata['info'] = '';
		}

		$this->load->view('welcome/news_view',$idata);

		$this->load->view('welcome/select_footer');
	}

    public function monthly_view()
    {
		$data = array(
			'type'	=> 'all',
			'value'	=> '',
			'tab'	=> '',
			'is_login'=>$this->session->userdata('user_id'),
		);
		$this->load->view('welcome/select_header',$data);

    	$month = $this->input->post('month');
    	if($month=='')
		{
			$month = date("Y-m");
		}
		$month = date("Y-m",strtotime($month));

		$this->load->model('m_news_monthly_report');
		$info = $this->m_news_monthly_report->report_info($month);
		if(isset($info->id))
		{
			$info	= $info->url;
		}
		else
		{
			$info 	= "";
		}

		$data = array(
			'date'     => $month,
			'month'		=> $month,
			'info'		=> $info,
		);
		$this->load->view('welcome/month_view',$data);

		//$this->load->view('welcome/select_footer');
    }

	public function companyview($id,$appview=false)
	{

		$data = array(
			'type'	=> 'all',
			'value'	=> '',
			'tab'	=> '',
			'is_login'=>$this->session->userdata('user_id'),
		);
		if(!$appview){
			$this->load->view('welcome/select_header',$data);
		}

		$this->load->model('m_contact_total');
		$company = $this->m_contact_total->get_field($id,'t_company');
		$company['tname'] = '';

		$this->load->model('m_contact_select');
		$contact = $this->m_contact_select->get_company_info($id);

		//企业类型
		$type = $this->m_contact_total->get_field($company['ctype'],'t_company_type');
		$allType = $this->m_contact_total->get_field(false,'t_company_type');
		$hashType = array();
		if(is_array($allType))
		{
			foreach($allType as $v)
			{
				$hashType[$v['id']] = $v['name'];
			}
		}
		$arr_type = explode('.',$type['detail']);
		if(is_array($arr_type))
		{
			foreach($arr_type as $v)
			{
				if($company['tname'] != '')$company['tname'] .= ' -> ';
				$company['tname'] .= $hashType[$v];
			}
		}


		$arr = array(
			'company'	=> $company,
			'contact'	=> $contact
		);

		if($appview){
			$this->load->view('welcome/company_view_app',$arr);
		}else {
			$this->load->view('welcome/company_view',$arr);
		}

		if(!$appview){
			$this->load->view('welcome/select_footer');
		}
	}

	//查看活动方案详情
	public function planview(){
		if($_GET['id']){
			$this->load->model('m_plan');
			$result = $this->m_plan->plan_show($_GET['id']);

		}
		$data = array(
			'type'	=> 'all',
			'value'	=> '',
			'tab'	=> '',
			'is_login'=>$this->session->userdata('user_id'),
		);
		$this->load->view('welcome/select_header',$data);
		$this->load->view('welcome/plan_view',$result);
		$this->load->view('welcome/select_footer');
	}
}
?>