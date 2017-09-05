<{include file="./header.tpl"}>
<div class="admin-biaogelist">
	
    <div class="listbiaoti am-cf">
      <ul class="am-icon-flag on"> 资源列表</ul>
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 > <a href="#">资源列表</a></dl>
      
      <dl>
        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="/service.php?business=dc&controller=member_resource&action=edit_show"><span class="am-icon-pencil-square-o"></span>添加资源</a>
      </dl>      
      
    </div>
	
	<div class="am-btn-toolbars am-btn-toolbar am-kg am-cf">  
</div>


    <form class="am-form am-g">
          <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped">
            <thead>
              <tr class="am-success">
                <th class="table-check"><input type="checkbox" /></th>
                <th class="table-id">ID</th>
                <th class="table-title">service_id</th>
                <th class="table-type">资源类型</th>
                <th class="table-type">文件类型</th>
                <th class="table-date am-hide-sm-only">创建日期</th>
                <th width="20%" class="table-set">操作</th>
              </tr>
            </thead>
            <tbody>
                <{foreach $aResource as $key=>$val}>
              <tr>
                <td><input type="checkbox" /></td>
                <td><{$val->id}></td>
                <td><{$val->service_id}></td>
                <td><{$val->source_type}></td>
                <td><{$val->content_type}></td>
                <td class="am-hide-sm-only"><{$val->ctime}></td>
                <td><div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="/service.php?business=dc&controller=member_resource&action=edit_show&id=<{$val->id}>'"><span class="am-icon-pencil-square-o"></span>编辑</a>
                  </div>
                  </div></td>
              </tr>
              <{/foreach}>              
            </tbody>
          </table>    
        </form>
            <style>
.tablemain table{width:400px; padding:10px; margin-top:50px; overflow:hidden; border:1px solid #CCC;} 
.tablemain thead{background:#eee;font-size:14px;} 
.tablemain th, .tablemain td {border:1px solid #ccc;padding: 0.3em;}
.tablemain td label{padding:0.2em;margin-right:0.1em;font-size:12px;font-family:Arial;}
.tablemain tr.line td{border-top:2px solid #999;font-size:12px;font-family:Arial;}
.tablemain img{border-top:2px solid #999;font-size:12px;font-family:Arial;}
</style>
              <table class="tablemain">
                    <tr>
                      <th>分时线</th>
                      <th>日k线</th>
                      <th>周k线</th>
                      <th>月k线</th>
                    </tr>
                    <tr>
                        <td><img src='http://image2.sinajs.cn/newchart/min/n/sh000001.gif?' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://image2.sinajs.cn/newchart/daily/n/sh000001.gif?' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://image2.sinajs.cn/newchart/weekly/n/sh000001.gif?' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://image2.sinajs.cn/newchart/monthly/n/sh000001.gif?' onload="AutoResizeImage(400,0,this)"></td>
                    </tr>
                    <tr>
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?id=ccih7&imageType=rf&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?ID=ccih7&UnitWidth=-6&imageType=KXL&EF=&Formula=RSI&type=D&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>   
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?ID=ccih7&UnitWidth=-6&imageType=KXL&EF=&Formula=RSI&type=W&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>   
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?ID=ccih7&UnitWidth=-6&imageType=KXL&EF=&Formula=RSI&type=M&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>                        
                    </tr>
                    <tr>
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?imageType=RF&id=3000592&token=4f1862fc3b5e77c150a2b985b12db0fd&_=0.6366265496689063' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?ID=3000592&Formula=RSI&EF=&ImageType=KXL&UnitWidth=-6&type=D&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>   
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?ID=3000592&UnitWidth=-6&imageType=KXL&EF=&Formula=RSI&type=W&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>   
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?ID=3000592&UnitWidth=-6&imageType=KXL&EF=&Formula=RSI&type=M&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>                        
                    </tr>
                    <tr>
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?imageType=RF&id=022025&token=4f1862fc3b5e77c150a2b985b12db0fd&_=0.6366265496689063' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?ID=022025&Formula=RSI&EF=&ImageType=KXL&UnitWidth=-6&type=D&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>   
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?ID=022025&UnitWidth=-6&imageType=KXL&EF=&Formula=RSI&type=W&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>   
                        <td><img src='http://pifm3.eastmoney.com/EM_Finance2014PictureInterface/Index.aspx?ID=022025&UnitWidth=-6&imageType=KXL&EF=&Formula=RSI&type=M&token=44c9d251add88e27b65ed86506f6e5da&r=0.005832342597346329' onload="AutoResizeImage(400,0,this)"></td>                        
                    </tr>
              </table>
 <{include file="./footer.tpl"}>
 
