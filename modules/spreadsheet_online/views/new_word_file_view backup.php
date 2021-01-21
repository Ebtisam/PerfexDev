<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
    <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                <div class="body">
                </div>
                </div>
            </div>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                <div class="body">
                <div class="row" style="margin: 15px;">
                    <?php echo form_hidden('type', 1);  ?>
                    <?php echo form_hidden('role', $role);  ?>
                    <?php echo form_hidden('token', $this->security->get_csrf_hash());  ?>
                    <?php echo form_open_multipart(admin_url('spreadsheet_online/new_word_file_view/'.$parent_id),array('id'=>'word-file-form'));?>
                    <input data-tips="Doc rename" id="word_info_detail_input" class="luckysheet_info_detail_input luckysheet-mousedown-cancel luckysheet" value="Untitled document" tabindex="0" dir="ltr" aria-label="Rename" style="visibility: visible; width: 220px;" data-tooltip="Rename">
                    
                    <a href="<?php echo admin_url('spreadsheet_online/manage'); ?>" id="luckysheet_info_detail_close" class="btn btn-danger luckysheet_info_detail_close"> <i class="fa fa-window-close" aria-hidden="true"></i> Close </a>
                    <button type="submit" id="word_info_detail_save" class="BTNSS btn btn-info word_info_detail_save"><i class="fa fa-save"></i> Save</button>
                    <!--<a id="luckysheet_info_detail_save_as" class="btn btn-info luckysheet_info_detail_save_as"> <i class="fa fa-save"></i> Save As </a>-->
                    <a id="tinymce_info_detail_export" class="btn btn-info" onclick="ExportToDoc();"> <i class="fa fa-download" aria-hidden="true"></i> Download </a>                    <!--<input class="" id="word_info_detail_input" />-->
                    <div style="margin: 15px;"></div>
                    <div style="margin: 15px;" id="mytextarea" name="tinymce_div"></div>
                        <?php echo form_hidden('name');  ?>
                        <?php echo form_hidden('parent_id', $parent_id);  ?>
                        <?php echo form_hidden('id', isset($id) ? $id : "");  ?>
                        <?php echo form_close(); ?>  
                </div>
                      

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="SaveAsModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title add-new"><?php echo _l('save_as') ?></h4>
			</div>
			
			<div class="modal-body">
				<label for="folder" class="control-label"><?php echo _l('leads_email_integration_folder') ?></label>
				<input type="text" id="folder" name="folder" class="selectpicker" placeholder="<?php echo _l('leads_email_integration_folder'); ?>" autocomplete="off">
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="SaveAsModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title add-new"><?php echo _l('save_as') ?></h4>
			</div>
			
			<div class="modal-body">
				<label for="folder" class="control-label"><?php echo _l('leads_email_integration_folder') ?></label>
				<input type="text" id="folder" name="folder" class="selectpicker" placeholder="<?php echo _l('leads_email_integration_folder'); ?>" autocomplete="off">
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<?php require 'modules/spreadsheet_online/assets/js/new_word_file_js.php'; ?>

<script>
        tinymce.init({
                    selector: '#mytextarea',
                    plugins: [
                        'advlist pagebreak autolink autoresize lists link image charmap hr',
                        'searchreplace visualblocks visualchars code',
                        'media nonbreaking table contextmenu',
                        'paste textcolor colorpicker'
                        ],
                    imagetools_cors_hosts: ['picsum.photos'],
                    menubar: 'file edit view insert format tools table help',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                    toolbar_sticky: true,
                    autosave_ask_before_unload: true,
                    autosave_interval: '30s',
                    autosave_prefix: '{path}{query}-{id}-',
                    autosave_restore_when_empty: false,
                    autosave_retention: '2m',
                    setup: function (editor) {
                        editor.on('init', function (e) {
                            if((<?php echo isset($data_form) ? "true" : "false"?>)){
                                var data = <?php echo isset($data_form) ? ($data_form != "" ? $data_form : '""') : '""' ?>;
                                //var dataSheet = data;
                                alert(data)
                                //tinymce.get("mytextarea").setContent(data);
                                //tinymce.activeEditor.setContent(data);
                                editor.setContent(data);
                                var title = "<?php echo isset($file_excel) ? $file_excel->name : "" ?>";
                                //alert(title);
                                 $("#word_info_detail_input").val( title);
                                }
                            
                        });}
            });
            
</script>
<script>
    function ExportToDoc(){
            var HtmlHead = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
        
            var EndHtml = "</body></html>";
            var myContent = tinymce.get("mytextarea").getContent();

            //complete html
            var html = HtmlHead +myContent+EndHtml;

            //specify the type
            var blob = new Blob(['\ufeff', html], {type: 'application/msword' });
            
            // Specify link url
            var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
            
            var doc_name = $("#word_info_detail_input").val();
            // Specify file name
            filename="untitled";
            filename = doc_name?filename+'.doc':doc_name+'.doc';
            
            // Create download link element
            var downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);
            
            if(navigator.msSaveOrOpenBlob ){
                navigator.msSaveOrOpenBlob(blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = url;
                
                // Setting the file name
                downloadLink.download = filename;
                
                //triggering the function
                downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
        }
</script>
<script>
    $("form#word-file-form").on('submit', function (e) {
    //ajax call here

    //stop form submission
        e.preventDefault();
        var rawData = tinymce.get("mytextarea").getContent();
        alert("submit");
        var finalData = JSON.stringify(rawData);
        alert(finalData);
        var formData = new FormData(this);
        var name = $("#word_info_detail_input").val();
        alert(name);
        var id = $("input[name='id']").val();
        formData.append('data_form', finalData);
        formData.append('name', name);
        formData.append('id', id);
        formData.append('image_flag', "false");
        formData.delete("mytextarea");
        //alert(formData.get("mytextarea"));
        $.ajax({
                    url: $(this).attr("action"),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    success: function (response, status, xhr) {
                        alert(response);
                        response = JSON.parse(response);
                        if(response.success == true) {
                        alert_float('success', response.message);
                        var disposition = xhr.getResponseHeader('content-disposition');
                        //$('#SaveAsModal').modal('hide');
                        }
                        else{
                        alert_float('warning', response.message);
                        }
                    },
                    cache: false,
                    processData: false
                    })

    });
</script>
<script>
$('.luckysheet_info_detail_save_as').on('click', function(){
          $('#SaveAsModal').modal('show');
            var old = $("input[name='parent_id']").val();

          $('#SaveAsModal [type="submit"]').on('click', function(){
            if(old != $("input[name='parent_id']").val()){
              $("input[name='id']").val('');
            }
              var url_form = $("form#word-file-form").attr('action');
              var rawData = tinymce.get("mytextarea").getContent();
                alert("submit save as");
                var finalData = JSON.stringify(rawData);
                alert(finalData);
                var formData = new FormData(this);
                var name = $("#word_info_detail_input").val();
                alert(name);
                var id = $("input[name='id']").val();
                formData.append('data_form', finalData);
                formData.append('name', name);
                formData.append('id', id);
                formData.append('image_flag', "false");
                formData.delete("mytextarea");
              if(typeof  $('input[name="csrf_token_name"]').val() !== 'undefined'){
                formData.append('csrf_token_name', $('input[name="csrf_token_name"]').val());
              }

              $.ajax({
                url: url_form,
                type: 'POST',
                data: formData,
                success: function (response, status, xhr) {
                  response = JSON.parse(response);
                  if(response.success == true) {
                    alert_float('success', response.message);
                    var disposition = xhr.getResponseHeader('content-disposition');
                    $('#SaveAsModal').modal('hide');
                  }
                  else{
                    alert_float('warning', response.message);
                  }
                },
                cache: false,
                contentType: false,
                processData: false
              })

          })
        });
</script>

</body>

</html>
