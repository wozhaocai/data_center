<{include file="./header.tpl"}>
<div class="admin-biaogelist">
	
    <div class="listbiaoti am-cf">
      <ul class="am-icon-flag on"> 栏目名称</ul>
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 > <a href="#">商品列表</a></dl>

      
      
    </div>
	
    <div class="fbneirong">
      <form class="am-form" id="resource_form" action="/service.php?business=dc&controller=member_resource&action=edit_submit" method="post">
        <div class="am-form-group am-cf">
          <div class="zuo">service_id：</div>
          <div class="you">
              <input type="text" name="service_id" class="am-input-sm" id="doc-ipt-text-1" value="<{$service_id}>">
          </div>
        </div>        
        <div class="am-form-group am-cf">
          <div class="zuo">资源类型</div>
          <div class="you">
            <select name="service_type" data-am-selected="{btnSize: 'sm'}">
              <option value="xml" selected>xml</option>
            </select>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">内容：</div>
          <div class="you">
            <textarea name="resource_content" id="resource_content" class="" rows="30" id="doc-ta-1"><{$resource_content}>"</textarea>
          </div>
        </div> 
        <div class="am-form-group am-cf">
          <div class="you" style="margin-left: 11%;">
              <button type="submit" id="sub" class="am-btn am-btn-secondary am-radius">保存</button>
              <input type="hidden" id="submit_action" name="submit_action" value="<{$submit_action}>">
          </div>
        </div>
      </form>
    </div>
<!--[if (gte IE 9)|!(IE)]><!--> 
<script src="/js/query.js"></script>
<!--<![endif]-->
 <{include file="./footer.tpl"}>
 
