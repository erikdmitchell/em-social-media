<?php global $emsm_admin; ?>

<pre>
	<?php print_r($emsm_admin); ?>
</pre>

<div class="wrap">
	
	<h1>EM Social Media Settings</h1>

	<form method="post" action="options.php">
		<?php wp_nonce_field('update_settings', 'em_social_meida_admin'); ?>
	
		<table class="form-table">
			<tbody>
				
				<?php foreach ($emsm_admin->social_media as $slug => $sm) : ?>

					<tr>
						<th scope="row"><?php echo $sm['name']; ?></th>
						<td>

							<input name="social_media_options[<?php echo $slug; ?>][url]" id="<?php echo $slug; ?>-url" class="regular-text code" type="url" value="<?php echo $sm['url']; ?>" />
							<span class="<?php echo $slug; ?>-icon-icon icon-img"><span class="icon-txt">Icon: </span><span class="icon-img-fa"><i class="fa <?php echo $sm['icon']; ?>"></i></span></span>
							
							<a class="icon-modal-link" data-input-id="<?php echo $slug; ?>-icon" rel="modal:open" name="fa-icons-overlay" href="#fa-icons-overlay">Select Icon</a>
	
							<input type="hidden" name="social_media_options[<?php echo $slug; ?>][icon]" id="<?php echo $slug; ?>-icon" value="ICON" />
							<input type="hidden" name="social_media_options[<?php echo $slug; ?>][name]" id="<?php echo $slug; ?>-name" value="NAME" />

						</td>
					</tr>
				
				<?php endforeach; ?>
				
			</tbody>
		</table>
	
		<input type="button" name="add-field" id="add-field" class="button button-primary add-field" value="Add Field">
	
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
	</form>

			$html=null;
		$fa_icons=$this->get_fa_arr();

		$html.='<div id="fa-icons-overlay">';
			$html.='<a class="close-modal" rel="modal:close"></a>';
			$html.='<ul class="fa-icons-list">';
				foreach ($fa_icons as $icon) :
					$html.='<li id="'.$icon['class'].'"><a href="#" data-icon="'.$icon['class'].'"><i class="fa '.$icon['class'].'"></i>'.$icon['name'].'</a></li>';
				endforeach;
			$html.='</ul>';
		$html.='</div>';

		return $html;
	
</div>