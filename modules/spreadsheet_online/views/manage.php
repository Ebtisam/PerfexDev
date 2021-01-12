<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="panel_s">
			<div class="panel-body">
				<h4 class="no-margin font-bold"><span class="glyphicon glyphicon-align-justify"></span> <?php echo html_entity_decode($title); ?></h4>
				<div class="clearfix"></div>
				<br>

				<div class="row">
					<div class="col-md-12">
						<div class="horizontal-scrollable-tabs preview-tabs-top">
							<div class="horizontal-tabs">
								<ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
									<li role="presentation" class="tab_cart <?php if($tab == 'my_folder'){ echo 'active'; } ?>">
										<a href="<?php echo admin_url('spreadsheet_online/manage?tab=my_folder'); ?>" aria-controls="tab_config" role="tab" aria-controls="tab_config">
											<?php echo _l('my_folder'); ?>
										</a>
									</li>
									<li role="presentation" class="tab_cart <?php if($tab == 'my_share_folder'){ echo 'active'; } ?>">
										<a href="<?php echo admin_url('spreadsheet_online/manage?tab=my_share_folder'); ?>" aria-controls="tab_config" role="tab" aria-controls="tab_config">
											<?php echo _l('my_share_folder'); ?>
										</a>
									</li>
								</ul>
							</div>
						</div> 
						<?php $this->load->view($tab); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<?php require 'modules/spreadsheet_online/assets/js/manage_js.php'; ?>
</body>
</html>