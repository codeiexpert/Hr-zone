<style>
.notice{
	display: none;
}
.heading {
    padding-left: 14px;
}
</style>
<div class="heading">
	<h1>HR Zone</h1>
</div>
<div class="main-d">	
	<div class="admin-hr-content">				
		<?php 
			$user = new WP_User( get_current_user_id() );

			if ( !empty( $user->roles ) && is_array( $user->roles ) ) {						
					$role = $user->roles[0];
			}
			
			if($role == 'administrator'){
				$forms = GFAPI::get_forms();
		?>

		<div class="gp-save-admin-content">
			<div class="top-select-form">
				<h4>Please select form for HR</h4>
				<select name="gp-save-select-form" id="gp-save-select-form">
					<option value="">Choose form</option>
					<?php
						foreach($forms as $form){
							if($form['cssClass'] != 'custom-duplicacy-form'){
					?>
						<option value="<?php echo $form['id']; ?>"><?php echo $form['title']; ?></option>
					<?php
							}
						}
					?>
				</select>
			</div>
			<div class="mid-select-form">
				<h4>Selected Form for HR</h4>
				<?php 
				$selected_forms = get_option('hr_selected_forms');
				// print_r($selected_forms);die;					
				?>
				<ul class="gp-form-select">
					<?php
					if(isset($selected_forms) && $selected_forms != ''){									
						foreach($selected_forms as $form){
						$form_data = GFAPI::get_form( $form );
						if($form_data['is_active'] != 0 && $form_data['is_trash'] != 1){
						$form_id = $form_data['id'];
						$label = $form_data['title'];									
					?>
						<li data-value="<?php echo $form_id; ?>" data-title="<?php echo $label; ?>"><?php echo $label; ?>  <a href="javascript:;" class="removeSelectedHr"> X </a></li>
					<?php
						}
						}
					}else{
					?>
					<li data-value="0">No Form Selected</li>
					<?php
					}
					?>
				</ul>
			</div>
			<div class="hr-form-submit">
				<button class="gp-save-hr-form-submit button button-primary">
					Submit
				</button>
			</div>
			
		</div>
		<?php
			}
		?>
	</div>
</div>