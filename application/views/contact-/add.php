<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>名片系统>名片录入</p>
    <div class="sst_sm">
      <?=$select?>
    </div>
  </div>
  <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/contact/add_total/" id="sub_form">
    <div class="caozuo4" >
      <input type="button" class="b_bnt01" value="名片扫描" onClick="scan()" <?=$usingie?'':'disabled="true" style="color:gray"'?>/>
      <?=$usingie?'<iframe name="scan_frame" id="scan_frame" src="/CardReading/index.html" style="display:none"></iframe>':'<font color="red">扫描控件只支持IE浏览器</font>'?>
    </div>
    <div class="con_detail">
      <table cellpadding="0" cellspacing="0" class="biaozhun">
        <tr>
          <td width="8%" class="cklt">姓 名：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="name" id="name" /></td>
          <td width="8%" class="cklt">星 级：</td>
          <td width="42%" class="cknr2"><div class="shop-rating">
              <ul class="rating-level" id="stars2">
                <li><a href="javascript:void(0);" class="one-star" star:value="20"></a></li>
                <li><a href="javascript:void(0);" class="two-stars" star:value="40"></a></li>
                <li><a href="javascript:void(0);" class="three-stars" star:value="60"></a></li>
                <li><a href="javascript:void(0);" class="four-stars" star:value="80"></a></li>
                <li><a href="javascript:void(0);" class="five-stars" star:value="100"></a></li>
              </ul>
              <span id="stars2-tips" class="result"></span>
              <input type="hidden" id="stars2-input" name="star" value="" size="2" />
            </div></td>
        </tr>
        <tr>
          <td colspan="4">
            <input type="hidden" id="c_id" value="0" />
            <input type="hidden" id="c_value" value="" />
		    <table cellspacing="0" cellpadding="0" class="biaozhun2">
              <tr class="tab_tit">
                <td width="30%">分 组</td>
                <td width="35%">单位名称</td>
                <td width="20%">职 务</td>
                <td width="15%"><input name="" type="button" value="新增" class="s_bnt01" id="add_company"/></td>
              </tr>
              <tr>
                <td id="td_company_type_1">
				  <p id="company_tname_1">-</p>
				  <input type="hidden" id="company_type_1" name="typeid[]" value=""/>
				</td>
                <td>
				  <input type="text" id="company_name_1" name="companyname[]" class="bzsr companyname" onkeyup="company_input(this.value,1,event.keyCode);" />
				  <input type="hidden" value="" id="company_id_1" name="companyid[]">
				  <div id="company_sel_1" style ="width:200px;border:solid 1px black;display:none;"></div>
                </td>
                <td>
                  <input type="text" class="bzsr" id="position_1" name="position[]"/>
                </td>
                <td></td>
              </tr>
              <tr id="last_company">
                <td colspan="3" style="height:0px;">
                  <input type="hidden" id="company_num" value="1" />
                </td>
              </tr>
            </table>
          </td>
        </tr>
		<tr>
          <td width="8%" class="cklt">手 机：</td>
          <td width="92%" colspan="3" class="cknr2">
            <input type="text" class="bzsr" name="mobile[]" id="mobile"/>
            <input type="button" value="+" class="tj_bnt" id="add_mob"/>
          </td>
        </tr>
        <tr id="sjxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <tr>
          <td width="8%" class="cklt">电 话：</td>
          <td width="92%" colspan="3" class="cknr2"><input type="text" class="bzsr" name="tel" id='tel' /></td>
        </tr>
        <tr>
          <td width="8%" class="cklt">传  真：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="fax" id="fax" /></td>
          <td width="8%" class="cklt">E-mail：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="email" id="email"/></td>
        </tr>
        <tr>
          <td width="8%" class="cklt">地 址：</td>
          <td width="92%" colspan="3" class="cknr2"><input type="text" class="bzsr8" name="address[]" id="address"/>
            <input name="" type="button" value="+" class="tj_bnt" id="add_addr"/>
          </td>
        </tr>
        <tr id="dzxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
		<tr>
          <td width="8%" class="cklt">名片主人：</td>
          <td width="42%" class="cknr2"><select class="bzsr2" name="owner" id="owner_option">
              <option value="0">全 部</option>
              <?php foreach($owner as $v) :?>
              <option value ="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
              <?php endforeach ?>
            </select>
          </td>
          <td width="8%" class="cklt">公开：</td>
          <td width="42%" class="cknr2"><input name="public" type="checkbox" value="1" /></td>
        </tr>
        <tr>
          <td width="8%" class="cklt">名 片：</td>
          <td colspan="3" class="cknr2">
		    <table width="100%" cellspacing="0" cellpadding="0">
		      <tr>
		        <td width="300">
		          <p>
				    <input type='text' class='bzsr' id='front' name="front" style="width:150px;" /> 
				    <input type="button" value="扫描" class="s_bnt01" <?=$usingie?'':'disabled="true"'?> style="margin:5px 2px; height:25px;<?=$usingie?'':'color:gray;'?>" onclick="scan1('front')" />
				    <input type="button" value="上传" class="s_bnt01" style="margin:5px 2px; height:25px;" onclick="$('#pic_form').submit();" />
				    <input type="button" value="浏览" class="s_bnt01" style="margin:5px 2px; height:25px;" onclick="$('#pic_id').val('front');$('#i_file').click();" />
			      </p>
		          <p class="hmyjjh" ><img src="/images/logo_03.jpg" id="front_img" style="margin-left:0px;" onclick="$('#front_img').attr('src',$('#front').val())" title="点击刷新图片" /></p>
		        </td>
		        <td width="300" class="mor_pic" style="padding-left:10px;">
		          <p>
				    <input type='text' class='bzsr' id='reverse' name="reverse" style="width:150px;" /> 
				    <input type="button" value="扫描" class="s_bnt01" <?=$usingie?'':'disabled="true"'?> style="margin:5px 2px;<?=$usingie?'':'color:gray;'?>" onclick="scan1('reverse')" title="点击刷新图片" />
				    <input type="button" value="上传" class="s_bnt01" style="margin:5px 2px;" onclick="$('#pic_form').submit();" />
				    <input type='button' value='浏览' class="s_bnt01" style="margin:5px 2px;" onclick="$('#pic_id').val('reverse');$('#i_file').click();" />
				  </p>
		          <p class="hmyjjh" ><img src="/images/logo_03.jpg" id="reverse_img" style=" margin-left:0px;" onclick="$('#reverse_img').attr('src',$('#reverse').val())" title="点击刷新图片" /></p>
		        </td>
		        <td align="left" valign="top" style="text-align:left;padding-left:10px;">
		          <span>*图片尺寸：300*200PX</span>
		          <br /><br />
		          <input type="button" value="+" class="tj_bnt tabn" id="add_pic" style=" position: relative; top: 10px; "/>
		          <input type="button" value="-" class="tj_bnt tabn" id="min_pic" style=" display: none; position: relative; top: 10px; "/>
		        </td>
		      </tr>
		    </table>
        </tr>
        <tr>
          <td width="8%" class="cklt"><input type="button" class="b_bnt01" style=" margin-left: 22px;" id="bnt_more" value="更多选项"/></td>
          <td width="92%" colspan="3" class="cknr2"></td>
        </tr>
        <tr id="mplr_more" style=" display: none; ">
          <td width="92%" colspan="4" class="cknr2"><table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8%" class="cklt">个人信息：</td>
                <td width="92%" colspan="3" class="cknr2"><textarea name="remark" cols="" rows="" class="bzsr4"></textarea></td>
              </tr>
              <tr>
                <td width="8%" class="cklt">区内事务：</td>
                <td width="92%" colspan="3" class="cknr2"><textarea name="affairs" cols="" rows="" class="bzsr4" id="affairs" ></textarea></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="caozuo5">
      <input type="botton" class="b_bnt01" value="保 存" onclick="checksubmit()"/>
      <input type="reset" class="b_bnt01" value="取 消"/>
    </div>
  </form>
</div>

<input type="hidden" id="pic_id" value="" />
<iframe name='pic_frame' id="pic_frame" style='display:none'></iframe>
<form id="pic_form" action="/index.php/contact/pic" encType="multipart/form-data"  method="post" target="pic_frame">
<input type="file" class="file" id="i_file" name="i_file" onchange="$('#'+$('#pic_id').val()).val(this.value);" style="position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" />
</form>

<script>
$(document).ready(function(){
	
	/* DIV高度随窗口变化 */
	$(function(){
		var h = 225;
		$('.con_detail').height($(window).height()-h);
		$(window).resize(function(){
			$('.con_detail').height($(window).height()-h);
		});
	});
	
	/* 添加单位 */
	$("#add_company").click(function(){
		var i = parseInt($("#company_num").val()) + 1;
		var tr = '<tr>'
			   +   '<td id="td_company_type_' + i + '">'
			   +     '<p id="company_tname_' + i + '">-</p>'
			   +     '<input type="hidden" id="company_type_' + i + '" name="typeid[]" value=""/>'
			   +   '</td>'
			   +   '<td>'
			   +     '<input type="text" id="company_name_' + i + '" name="companyname[]" class="bzsr companyname" onkeyup="company_input(this.value,' + i + ',event.keyCode)" />'
			   +     '<input type="hidden" value="" id="company_id_' + i + '" name="companyid[]">'
			   +     '<div id="company_sel_' + i + '" style ="width:200px;border:solid 1px black;display:none;"></div>'
			   +   '</td>'
			   +   '<td>'
			   +     '<input type="text" class="bzsr" name="position[]"/>'
			   +   '</td>'
			   +   '<td><input type="button" value="删除" class="s_bnt01 red" onclick="del_company(this)" /></td>'
			   + '</tr>';
              
		$("#last_company").before(tr);
		
		$("#company_num").val(i);
	});

	/* 添加电话 */
	$("#add_mob").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='mobile[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#sjxx").before(tr);
	});
	
	/* 添加地址 */
	$("#add_addr").click(function(){
		var tr = "<tr class='mdz'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr8' name='address[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_addr(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#dzxx").before(tr);
	});
	
	/* 添加名片图片2 */
	$("#add_pic").click(function(){
		$(".mor_pic").show();
		$("#min_pic").show();
		$(this).hide();
	});
	/* 删除名片图片2 */
	$("#min_pic").click(function(){
		$(".mor_pic").hide();
		$("#add_pic").show();
		$(this).hide(); 
	});
	
	/* 更多选项 */
	$("#bnt_more").click(function(){
		$("#mplr_more").fadeToggle("fast");
	});
});
/* 删除单位 */
function del_company(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 删除电话 */
function min_mob(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 删除地址 */
function min_addr(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}

/******** 调用控件 ********/
var isLoad = false;//已加载
var isCard = false;//是否扫描名片信息
var pic_id = 'front';
/* 名片扫描 */
function scan()
{
	if(!isLoad)
	{
		window.frames["scan_frame"].LoadRecogKenal();
		isLoad = true;
	}
	isCard = true;
	pic_id = 'front';
	
	window.frames["scan_frame"].RecognizeImg();
}
/* 图片扫描 */
function scan1(id)
{
	if(!isLoad)
	{
		window.frames["scan_frame"].LoadRecogKenal();
		isLoad = true;
	}
	isCard = false;
	pic_id = id;
	
	window.frames["scan_frame"].RecognizeImg();
}
/* 名片扫描后图片处理 */
function scan_pic(src,info)
{
	$("#"+pic_id).val(src);
	$("#"+pic_id+"_img").attr('src',src);
	
	/* 识别 */
	if(isCard)
	{
		var arr = info.split("\r\n");
		if(arr[0]=='识别成功')
		{
			for(var i=1;i<arr.length;i++)
			{
				if(arr[i]=='')continue;
				var t = arr[i].toString().indexOf(":");
				if(t>0)
				{
					var name = arr[i].substr(0,t);
					var value = arr[i].substr(t+1);
					if(name=='姓名')		$("#name").val(value);
					if(name=='职务/部门')	$("#position_1").val(value);
					if(name=='手机')		$("#mobile").val(value);
					if(name=='公司')
					{
						$("#company_name_1").val(value);
						company_input(value,i,13);
					}		
					if(name=='地址')		$("#address").val(value);
					if(name=='电话')		$("#tel").val(value);
					if(name=='传真')		$("#fax").val(value);
					if(name=='电子邮箱')	$("#email").val(value);
//					if(name=='网址')		$("#web").val(value);
//					if(name=='邮编')		$("#postalcode").val(value);
				}
			}
		}
	}
}
/******** 调用控件 ********/

/* 上传图片后，返回显示 */
function pic_back(re)
{
	if(re=='false')
	{
		alert('图片上传失败');
	}
	else
	{
		$("#"+$('#pic_id').val()).val(re);
		$("#"+$('#pic_id').val()+"_img").attr("src",re);
	}
}

/* 单位名称输入 */
function company_input(value,i)
{
	if($('#c_value').val()!=value)
	{
		$('#c_id').val(i);
		$('#c_value').val(value);
		
		$("#company_sel_"+i).hide();
		
		if(value=='')
		{
			return;
		}
		$.post(
			"/index.php/contact/get_company_by_code",
			{
				name : value,
			},
			function (data) //回传函数
			{
				if(data=='[]')
				{
					get_cinfo(i)
				}
				else
				{
					var html = '';
					var obj = eval('('+data+')');
					for(var k in obj)
					{
						var v = obj[k];
						html += '<a onclick="$(\'#company_name_'+i+'\').val(\''+v.name+'\');get_cinfo('+i+');">'+v.name+'</a><br />';
						$("#company_sel_"+i).html(html);
						$("#company_sel_"+i).show();
					}
				}
			}
		);
	}
}
/* 根据单位名称获取类型 */
function get_cinfo(i){
	var name = $('#company_name_'+i).val();
	$.post(
		"/index.php/contact/get_company_name",
		{
			name:name,
		},
		function (data) //回传函数
		{
			if(data == 0){
				var html = "<select class='bzsr2' name='typeid[]'>"
						 +   "<option value='0'>请选择</option>"
						 +   "<? 
							 foreach($type as $v){
							 	$arr = explode('.',$v['detail']);
							 	$len = count($arr);
							 	$sp='';
							 	for($i=0;$i<$len-1;$i++){
							 		$sp .= "&nbsp;&nbsp;";
							 	}
						     ?>"
						 +   "<option value='<?=$v['id']?>'><?=$sp?><?=$v['name']?></option>"
						 +   "<?
						 	 }
						     ?>"
						 + "</select>";
				$('#td_company_type_'+i).html(html);
			}else{
				var obj = eval('('+data+')');
				$('#company_tname_'+i).html(obj.typename);
				$('#company_type_'+i).val(obj.typeid);
				$('#company_id_'+i).next().val(obj.id);
			}
			
		}
	);
	$("#company_sel_"+i).hide();	
}
</script>
<script>
/* 提交前判断 */
function checksubmit()
{
	if($("#name").val()==''){
		alert("请填写联系人姓名");
		return false;
	}
	
	$("input[name='companyname[]']").each(function(){
		if(this.value=='')
		{
			alert("请填写单位名称");
			return false;
		}
	});
	$("input[name='position[]']").each(function(){
		if(this.value=='')
		{
			alert("请填写职务");
			return false;
		}
	});
	$("input[name='typeid[]']").each(function(){
		if(this.value=='')
		{
			alert("请选择分组");
			return false;
		}
	});
	$("#sub_form").submit();
}
</script>
<script> 
/**评星**/
var TB = function() {
var T$ = function(id) { return document.getElementById(id) }
var T$$ = function(r, t) { return (r || document).getElementsByTagName(t) }
var Stars = function(cid, rid, hid, config) {
var lis = T$$(T$(cid), 'li'), curA;
for (var i = 0, len = lis.length; i < len; i++) {
lis[i]._val = i;
lis[i].onclick = function() {
T$(rid).innerHTML = '<em>' + (T$(hid).value = T$$(this, 'a')[0].getAttribute('star:value')) + '</em>';
curA = T$$(T$(cid), 'a')[T$(hid).value / config.step - 1];
};
lis[i].onmouseout = function() {
curA && (curA.className += config.curcss);
}
lis[i].onmouseover = function() {
curA && (curA.className = curA.className.replace(config.curcss, ''));
}
}
}; 
return {Stars: Stars}
}().Stars('stars2', 'stars2-tips', 'stars2-input', {
'info' : ['', '', '', '', ''],
'curcss': ' current-rating',
'step': 20
});
</script>