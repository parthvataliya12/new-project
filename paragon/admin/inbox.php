<?php
include('../connect.php'); 
if($_SESSION['user']['type']!='AdmiN')
{
		header('Location:'.$SITE_URL);
}
$pg_name = 'inbox'; 
$admin_id = $_SESSION['user']['id'];

	$start=0;
	$limit=10;
	
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		$start = ($page-1)*$limit;
	}
	else{
		$page=1;
	}
	
	$qry_msgs = "SELECT * FROM messages WHERE msg_receiver_user_type = 'admin' AND msg_admin_id = ".$admin_id." AND msg_is_deleted_admin = 'N' order by id DESC LIMIT $start , $limit";
	
	$res_msgs = mysql_query($qry_msgs);
	$res_msgs_content = mysql_query($qry_msgs);
	
	$total_inbox_msgs = mysql_num_rows(mysql_query( "SELECT * FROM messages WHERE msg_receiver_user_type = 'admin'  AND  msg_admin_id = ".$admin_id." AND msg_is_deleted_admin = 'N' "));
	$total_rows = ceil($total_inbox_msgs/$limit);
	
	
	$qry_sent_msgs = "SELECT * FROM messages WHERE msg_sender_user_type = 'admin' AND msg_admin_id = ".$admin_id." AND msg_is_deleted_admin = 'N'";
	$res_sent_msgs = mysql_query($qry_sent_msgs);
	$total_sent_msgs = mysql_num_rows($res_sent_msgs);
	
	$qry_trash_msgs = "SELECT * FROM messages WHERE msg_admin_id =".$admin_id." AND msg_is_deleted_admin = 'Y' order by id DESC";
	$res_trash_msgs = mysql_query($qry_trash_msgs);
	$total_trash_msgs = mysql_num_rows($res_trash_msgs);
	
	/*$qry_trash_msgs =  "SELECT * FROM messages WHERE msg_manager_id =".$manager_id." AND msg_is_deleted_manager = 'Y' order by id DESC";
	$res_trash_msgs = mysql_query($qry_trash_msgs);
	$total_trash_msgs = mysql_num_rows($res_trash_msgs);*/
?>
<?php require 'inc/config.php'; ?>
<?php require 'inc/views/template_head_start.php'; ?>
<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>
<!-- Page Header -->

<div class="content bg-gray-lighter">
  <div class="row items-push">
    <div class="col-sm-7">
      <h1 class="page-heading"> BANDEJA DE ENTRADA </h1>
    </div>
    <div class="col-sm-5 text-right hidden-xs">
      <ol class="breadcrumb push-10-t">
        <li>Home</li>
        <li><a class="link-effect" href="">BANDEJA DE ENTRADA</a></li>
      </ol>
    </div>
  </div>
</div>
<!-- END Page Header -->
<!-- Page Content -->
<div class="content">
  <div class="row">
  <?php if(isset($_REQUEST['msg'])&&$_REQUEST['msg']=='sent'){?>
    <div class="col-sm-12 col-lg-12" data-animation-class="zoomInDown">
      <!-- Success Alert -->
      <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
        <h3 class="font-w300 push-15">Exito..!</h3>
        <p><a href="javascript:void(0)" class="alert-link">Se envia el mensaje.</a></p>
      </div>
      <!-- END Success Alert -->
    </div>
 <?php }?>
    <div class="col-sm-5 col-lg-4">
      <!-- Collapsible Inbox Navigation (using Bootstrap collapse functionality) -->
      <button class="btn btn-block btn-primary visible-xs push" data-toggle="collapse" data-target="#inbox-nav" type="button">Navigation</button>
      <div class="collapse navbar-collapse remove-padding" id="inbox-nav">
        <!-- Inbox Menu -->
        <?php include('msg_menu.php');?>
        <!-- END Inbox Menu -->
      </div>
      <!-- END Collapsible Inbox Navigation -->
    </div>
    <div class="col-sm-7 col-lg-8">
      <!-- Message List -->
      <div class="block">
        <div class="block-header bg-gray-lighter">
          <ul class="block-options">
            <?php if($page > 1){?>
            <li>
              <button onclick="javascript:window.location.href = '<?php echo "?page=".($page-1).""; ?>';" class="js-tooltip" title="" type="button" data-toggle="block-option" data-original-title="Previous <?php echo $limit;?> Messages"><i class="si si-arrow-left"></i></button>
              </a> </li>
            <?php }?>
            <?php if($page != $total_rows){?>
            <li>
              <button onclick="javascript:window.location.href = '<?php echo "?page=".($page+1).""; ?>';" class="js-tooltip" title="" type="button" data-toggle="block-option" data-original-title="Next <?php echo $limit;?> Messages"><i class="si si-arrow-right"></i></button>
            </li>
            <?php }?>
            <li>
              <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo" onclick="javascritp:location.reload();"><i class="si si-refresh"></i></button>
            </li>
            <li>
              <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
            </li>
          </ul>
        </div>
        <div class="block-content">
          <!-- Messages Options -->
          <div class="push">
            <button id="btn_del_msgs" class="btn btn-default pull-right" type="button"><i class="fa fa-times text-danger push-5-l push-5-r"></i> <span class="hidden-xs">Borrar</span></button>
            <div class="btn-group"> </div>
          </div>
          <!-- END Messages Options -->
          <!-- Messages & Checkable Table (.js-table-checkable class is initialized in App() ->
          uiHelperTableToolsCheckable()) -->
          <div class="pull-r-l">
            <table class="js-table-checkable table table-hover table-vcenter">
              <tbody>
                <?php 
				$f6 = "font-w600";
				$f7 = "font-w700";
				$trbg = "style = background:#E1E1E1";
				//$count_unread = 0;
			  	while($row_msgs = mysql_fetch_array($res_msgs)){
				$is_read = $row_msgs ['msg_is_read_admin'];
				$admin_id = $row_msgs['msg_admin_id'];
			  ?>
                <tr <?php echo $is_read == 'Y' ? '':  $trbg ;?>>
                  <td class="text-center" style="width: 70px;"><label class="css-input css-checkbox css-checkbox-primary">
                    <input type="checkbox" name="chk_del" id="chk_del_<?php echo $row_msgs['id'];?>" value="<?php echo $row_msgs['id'];?>">
                    <span></span> </label>
                  </td>
                  <td id = "sender_name" class="hidden-xs <?php echo $is_read == 'Y' ? $f6 : $f7 ;?>" style="width: 140px;"><?php echo Get_one_value("managers","m_name",$row_msgs['msg_manager_id'],'id','') ?></td>
                  <td><a class="<?php echo $is_read == 'Y' ? $f6 : $f7 ;?>" id="open_msg" data-msg = "<?php echo $row_msgs['id']; ?>" data-toggle="modal" data-target="#modal-message-<?php echo $row_msgs['id']; ?>" href="#"><?php echo $row_msgs['msg_sub']; ?></a>
                    <div class="text-muted push-5-t <?php echo $is_read == 'Y' ? '' : $f7 ;?>" ><?php echo substr(strip_tags($row_msgs['msg_body']),0,24)." ..."; ?></div></td>
                </tr>
                <?php //if($is_read == 'N'){$count_unread++;} 
				} ?>
              </tbody>
            </table>
          </div>
          <!-- END Messages -->
        </div>
      </div>
      <!-- END Message List -->
    </div>
  </div>
</div>
<!-- END Page Content -->
<?php require 'inc/views/base_footer.php'; ?>
<!-- Compose Modal -->
<!-- END Compose Modal -->
<!-- Message Modal -->
<?php while($row_content = mysql_fetch_array ($res_msgs_content)){?>
<div class="modal fade" id="modal-message-<?php echo $row_content['id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popout">
    <div class="modal-content">
      <div class="block block-themed block-transparent remove-margin-b">
        <div class="block-header bg-primary-dark">
          <ul class="block-options">
            <li>
              <button data-toggle="tooltip" data-placement="left" title="Reply" type="button" onclick="javascript:window.location.href = '<?php echo SITE_URL."admin/compose.php?user_id=".$row_content['msg_manager_id'];?>'"><i class="si si-action-undo"></i></button>
            </li>
            <li>
              <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
            </li>
          </ul>
          <h3 class="block-title"><?php echo $row_content['msg_sub']; ?></h3>
          <h4 class=" block-title text-right"><?php echo date('H:m:s d/m/Y ',strtotime($row_content['msg_date'])); ?></h4>
        </div>
        <div class="block-content"> <?php echo $row_content['msg_body']; ?>
          </p>
        </div>
        <div class="block-content bg-gray-lighter">
          <div class="row items-push">
            <?php
				$qry_msg_files = "SELECT * FROM message_files WHERE msg_id = ".$row_content['id']." order by id";
				$res_files = mysql_query($qry_msg_files);
				while($row_files = mysql_fetch_array($res_files)){?>
            <div class="col-sm-4">
              <div class="img-container fx-img-zoom-in">
                <?php if(is_valid_image($row_files['msg_file_name'])){?>
                <img class="img-responsive" src="<?php echo $SITE_URL."user_files/admin/".$row_files['msg_file_name'];?>" alt="">
                <?php }else{?>
                <img class="img-responsive" src="<?php echo $one->assets_folder?>/img/folder-icon.png" alt="">
                <?php }?>
                <div class="img-options">
                  <div class="img-options-content"> <a class="btn btn-sm btn-default" download href="<?php echo $SITE_URL."user_files/admin/".$row_files['msg_file_name'];?>"><i class="fa fa-download"></i> Download</a> </div>
                </div>
              </div>
              <div class="font-s13 text-muted push-5-t"><?php echo $row_files['msg_file_name']; ?></div>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }?>

<!-- END Message Modal -->
<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>

<script src="<?php echo $one->assets_folder; ?>/js/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
<script>
    $(function(){
        // Init page helpers (Table Tools helper + Easy Pie Chart plugin)
        App.initHelpers(['table-tools', 'easy-pie-chart']);
    });
</script>
<script type="text/javascript">

$(document).ready(function(){
	//svar count_unread = '<?php echo  $count_unread;?>';
	//var user_id = '<?php echo $user_id;?>';
	
	//$("span#inbox_unread").html(count_unread);
	
	$("tr td #open_msg").each(function(){
		$(this).click(function(){
			msg_id = $(this).attr("data-msg");
			
			
			flag = 'msg_status';
			 $.ajax({
			  url: 'ajax_process.php',
			  //data: {"msg_id":msg_id,"user_id":user_id,"flag":flag},
			   data: {"msg_id":msg_id,"flag":flag},
			  success: function(data) {
				if(data)
				{
					$("#sidebar .sidebar-content ul.nav-main li span#change_unread_count,ul.dropdown-menu li span#menu_unread_count").html(data);
					
				}
			  },
			  type: 'POST'
		   });
		   if($(this).hasClass('font-w700'))
		   {
		   	 $(this).removeClass('font-w700');	
			 $(this).addClass('font-w600');	
		   }	
		   if($(this).parent().prev().hasClass('font-w700'))
		   {
		   	 $(this).parent().prev().removeClass('font-w700');	
			 $(this).parent().prev().addClass('font-w600');	
		   }
		   if($(this).next().hasClass('font-w700'))
		   {
		   	 $(this).next().removeClass('font-w700');	
			 $(this).next().addClass('font-w600');	
		   }
		   $(this).parent().parent().css("background","none");
		});
	});
	 
	$("#btn_del_msgs").click(function(){
		
		var flag2 = 'msg_trash';
		var del_msgs = [];
     	$('input[name=chk_del]:checked').each(function() {
      		 del_msgs.push($(this).val());
			 $(this).parent().parent().parent().remove();
    	 });
	
		 $.ajax({
			  url: 'ajax_process.php',
			  data: {"msg_ids":del_msgs,"flag":flag2},
			  success: function(data) {
				if(data=='success')
				{
					location.reload();
					
				}
			  },
			  type: 'POST'
		   });
		
	}); 
	
});
</script>
<?php require 'inc/views/template_footer_end.php'; ?>
