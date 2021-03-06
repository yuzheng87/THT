<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-12-10
 * Time: 下午2:04
 */

/*
 * 联系人模块
 * 联系人管理
 * 连接表名：contact
 */

class M_contact extends CI_Model
{
	var $table_name		= 't_contact';
	var $table_comp		= 't_company';
	var $table_nexus	= 't_company_contact';
	
    function __construct()
    {
        $this->load->database();
    }
    
    /**
     * 新增联系人
     */
    function contact_insert($data,$company)
    {
		$this->db->trans_start();
		
		//新增联系人表，获取ID
		$this->db->insert($this->table_name,$data);
		$contact_id = $this->db->insert_id();
		//var_dump($company);
		$arr_nexus = array();
		if(is_array($company))
		{
			foreach($company as $k => $p)
			{
				$arr_nexus[$k]['contact_id']	= $contact_id;
				$arr_nexus[$k]['type_id']		= $p['type'];
				$arr_nexus[$k]['position']		= $p['posn'];
				if($p['cpid']=='')
				{
					//无企业信息，需新增
					$cdata = array(
						'name'	=> $p['comp'],
                        'ctype'	=> $p['type'],
                        'url'   =>$p['url'],
                        'postcode'=>$p['postcode'],
                        'settle'=> $p['settle']
					);
					$this->db->insert($this->table_comp,$cdata);
					$arr_nexus[$k]['company_id'] = $this->db->insert_id();
				}
				else
				{
                    $cdata=array(
                        'name'	=> $p['comp'],
                        'url'   =>$p['url'],
                        'postcode'=>$p['postcode'],
                    );
                    //var_dump($p['cpid']);
                    $this->db->where(array('id'=>$p['cpid']))->update($this->table_comp,$cdata);
					$arr_nexus[$k]['company_id']	= $p['cpid'];
				}
			}
			$this->db->insert_batch($this->table_nexus,$arr_nexus);
		}
		
		
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    return false;
		}
		else
		{
		    $this->db->trans_commit();
		    return true;
		}
    }
    
    function contact_update($id,$data,$company,$del)
    {
		$this->db->trans_start();
//        var_dump($id);
//		var_dump($data);
//        var_dump($company);
		//修改联系人信息
		$this->db->where('id', $id);
		$this->db->update($this->table_name, $data);

		//删除联系人单位信息
		$this->db->where_in('id', $del);
		$this->db->delete($this->table_nexus);

		$insert = array();
		foreach($company as $v)
		{
			$arr_tmp = array(
				'contact_id'	=> $id,
				'type_id'		=> $v['type'],
				'position'		=> $v['posn'],

			);
            $arr_comp=array(
                'url'           =>$v['url'],
                'postcode'      =>$v['postcode']
            );
			if($v['cpid']=='')
			{
				//无企业信息，需新增
				$cdata = array(
					'name'	=> $v['comp'],
					'ctype'	=> $v['type'],
                    'settle'=> $v['settle'],
                    'url'   => $v['url'],
                    'postcode'=>$v['postcode']

				);
				$this->db->insert($this->table_comp,$cdata);
				$arr_tmp['company_id'] = $this->db->insert_id();
			}
			else
			{
				$arr_tmp['company_id']	= $v['cpid'];
                $this->db->where('id',$v['cpid']);
                $this->db->update($this->table_comp,$arr_comp);
			}

			if($v['id']!='' && $v['id']>0)
			{
				$this->db->where('id', $v['id']);
				$this->db->update($this->table_nexus, $arr_tmp);
			}
			else
            {
                $insert[] = $arr_tmp;
            }
		}
		if(count($insert)>0)
		{
			$this->db->insert_batch($this->table_nexus,$insert);
		}


		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    return false;
		}
		else
		{
		    $this->db->trans_commit();
		    return true;
		}
    }

    /*
     * 将企业，联系人，往来活动组成一个表
     * @param int id：在联表中 主表id
     */
    public function join_arr($id)
    {
        $this->db->select('t_contact.name contactname,t_contact.id contactid,t_contact.*,t_company.name companyname,t_company.ctype type,t_company.*,t_activity.*');
        $this->db->from('t_contact'); //主表
        $this->db->join('t_company', 't_contact.company =t_company.id', 'left outer');
        $this->db->join('t_activity', 't_contact.id =t_activity.contact ', ' left outer');

        if ($id) {
            $query = $this->db->where('t_contact.id', $id)->get();
            return $query->row_array();
        } else {
            $query = $this->db->get();
            return $query->result_array();
        }


    }
    
    public function get_num()
    {
        $query = $this->db->where('del', '0')->get('t_contact');
        return $query->num_rows;
    }

    /*
     * 搜索条件：通过id
     * $where 通过企业查询
     */
    public function get_field($id = FALSE, $where = FALSE,$start='0',$pageSize='0')
    {
		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		
        if ($where) {
            $query = $this->db->where('del', '0')->get_where('t_contact', $where);
            return $query->result_array();
        }
        if ($id === FALSE) {
            $query = $this->db->where('del', '0')->get('t_contact');
            return $query->result_array();
        }
        
        $query = $this->db->get_where('t_contact', array('id' => $id));
        return $query->row_array();
    }

    /*
     * 获得名片主人和企业名称
     */

    public function model_list($tablename, $id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get($tablename);
            return $query->result_array();
        }

        $query = $this->db->where('id', $id)->get($tablename);
        return $query->result_array();
    }
//只删除使用中
    /*
     * 删除
     * @param string $id 操作项id
     */
    public function stop_field($id)
    {
        return $this->db->where_in('id', explode(',',$id))->update('t_contact', array('del' => 1));
    }


    /*
     * 增加联系人
     * @param string logo 的上传路径（暂时是绝对路径）
     * @param string 产品图片的上传路径（暂时是绝对路径）
     */
    public function add_field($logo, $logo_reverse)
    {
        //去重并去空值
        $mobArr = array_filter(array_unique($_POST['mobile']));
        $mobile = implode(',', $mobArr);

        $data = array(
            'owner' => $this->input->post('owner'),
            'company' => $this->input->post('company'),
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position'),
            'tel' => $this->input->post('tel'),
            'mobile' => $mobile,
            'fax' => $this->input->post('fax'),
            'email' => $this->input->post('email'),
            'remark' => $this->input->post('remark'),
            'app_department' => $this->input->post('add_depart'),
            'app_user' => $this->input->post('add_user'),
            'pic_front' => $logo,
            'pic_reverse' => $logo_reverse,
            'addtime' => time()

        );

        return $this->db->insert('t_contact', $data);
    }


    /*
     * 处理编辑
     * @param string logo 的上传路径（暂时是绝对路径）
     * @param string 产品图片的上传路径（暂时是绝对路径）
     */
    public function edit_field($id, $logo, $logo_reverse)
    {
        //去重并去空值
        $mobArr = array_filter(array_unique($_POST['mobile']));
        $mobile = implode(',', $mobArr);

        $data = array(
            'owner' => $this->input->post('owner'),
            'company' => $this->input->post('company'),
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position'),
            'tel' => $this->input->post('tel'),
            'mobile' => $mobile,
            'star' => $this->input->post('star'),
            'fax' => $this->input->post('fax'),
            'email' => $this->input->post('email'),
            'remark' => $this->input->post('remark'),
            'app_department' => $this->input->post('add_depart'),
            'app_user' => $this->input->post('app_user'),
            'pic_front' => $logo,
            'pic_reverse' => $logo_reverse
        );

        return $this->db->where('id', $id)->update('t_contact', $data);
    }
}