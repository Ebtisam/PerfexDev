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
                    <a id="word_info_detail_save_as" class="btn btn-info word_info_detail_save_as"> <i class="fa fa-save"></i> Save As </a>
                    <a id="tinymce_info_detail_export" class="btn btn-info" > <i class="fa fa-download" aria-hidden="true"></i> Download </a>                    <!--<input class="" id="word_info_detail_input" />-->
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

<?php init_tail(); ?>
<?php require 'modules/spreadsheet_online/assets/js/new_word_file_js.php'; ?>

<script>

</script>

</body>

</html>
