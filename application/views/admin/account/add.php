<!--<script language="javascript" src="--><?php //echo base_url('public')?><!--/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<!--<script type="text/javascript" src="--><?php //echo base_url();?><!--public/ckfinder/ckfinder.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>public/scripts/ckeditor/ckeditor.js"></script>
<!--<script src="modules/scripts/ckeditor/ckeditor.js" type="text/javascript"></script>-->

<div class="page-title">
	<div class="title_left"><h3>Thêm sự kiện mới</h3></div>
	<div class="title_right">
		<div class="col-md-6 col-sm-6 col-xs-12 pull-right">
			<a href="<?php echo admin_url('event/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
			<a href="<?php echo admin_url('event')?>" class="btn btn-info btn-sm">Danh sách</a>
		</div>
	</div>
</div>
<div class="x_panel">
	<?php if ($message){$this->load->view('admin/message',$this->data); }?>
	<form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
		    <div class="form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên sự kiện <span class="required">*</span></label>
        	<div class="col-md-8 col-sm-8 col-xs-12">
          		<input type="text" id="txtName" name="txtName" value="" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
      	<div class="form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Giới thiệu ngắn <span class="required">*</span></label>
        	<div class="col-md-8 col-sm-8 col-xs-12">
              	<textarea name="txtIntro" class="form-control" style="height: 120px"></textarea>
          	</div>
      	</div>
      	<div class="form-group">
          	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Thời gian <span class="required">*</span></label>
          	<div class="col-md-8 col-sm-8 col-xs-12">
	          	<span style="float: left;margin-top: 7px">Từ ngày: </span>
	          	<div class="col-md-3 col-sm-3 col-xs-12">
	          		<input type="text" id="txtFrom" name="txtFrom" required="required" class="form-control col-md-7 col-xs-12">
	          	</div>
	          	<span style="float: left;margin-top: 7px">Đến ngày: </span>
	          	<div class="col-md-3 col-sm-3 col-xs-12">
	          		<input type="text" id="txtTo" name="txtTo" required="required" class="form-control col-md-7 col-xs-12">
	          	</div>
          	</div>
        </div>
      	<div class="form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ảnh sự kiện <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="file" id="imageEvent" name="imageEvent" value="" required="required" style="padding: 5px;" accept="image/*">
              <img id="pre_img" style="width: 150px" />
        	</div>
      	</div>
        <div class="form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nội dung sự kiện <span class="required">*</span></label>
          <div class="col-md-8 col-sm-8 col-xs-12">
              <textarea name="txtContent" class="form-control" style="height: 120px" id = "txt"></textarea>
<!--              <script type="text/javascript">CKEDITOR.replace('txtContent',{height: '300px'}); </script>-->
<!---->
<!--              <td class="editRight">-->
<!--											<textarea name="content" id = "txt">-->
<!---->
<!--											</textarea>-->
<!--              </td>-->

          </div>
        </div>
      	<div class="form-group">
        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
          		<input type="submit" id="btnAddEvent" name="btnAddEvent" required="required" class="btn btn-success" value="Thêm">
        	</div>
      	</div>
	</form>
    <script lang="text/javascript">CKEDITOR.replace("txt");</script>

</div>

<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
        $("#imageEvent").change(function(){
            readURL(this);
        });
        function readURL(input) {
        if (input.files && input.files[0]) {
              var reader = new FileReader();
                  reader.onload = function (e) {
                  $('#pre_img').attr('src', e.target.result);
              }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {				    				    
		var editor = CKEDITOR.replace('txtContent', {
			height: '300px',
			filebrowserBrowseUrl : '<?php echo base_url()."public/ckfinder/ckfinder.html"; ?>',
			filebrowserImageBrowseUrl : '<?php echo base_url()."public/ckfinder/ckfinder.html?Type=Images";?>',
			filebrowserFlashBrowseUrl : '<?php echo base_url()."public/ckfinder/ckfinder.html?Type=Flash" ?>',
			filebrowserUploadUrl : '<?php echo base_url()."public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files"?>',
			filebrowserImageUploadUrl : '<?php echo base_url()."public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";?>',
			filebrowserFlashUploadUrl : '<?php echo base_url()."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash";?>',
			filebrowserWindowWidth : '800',
			filebrowserWindowHeight : '480'
		});
		CKFinder.setupCKEditor( editor, "<?php echo base_url().'public/ckfinder/'?>" );
	});
</script> -->
