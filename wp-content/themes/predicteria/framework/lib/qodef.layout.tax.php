<?php

/*
   Class: WellExpoSelectClassTaxonomyField
   A class that initializes WellExpoSelectClass Taxonomy Field
*/

class WellExpoSelectClassTaxonomyField implements iWellExpoSelectInterfaceRender {
	private $type;
	private $name;
	private $label;
	private $description;
	private $options = array();
	private $args = array();
	private $hidden_property;
	private $hidden_values = array();
	
	function __construct( $type, $name, $label = "", $description = "", $options = array(), $args = array(), $hidden_property = "", $hidden_values = array() ) {
		$this->type            = $type;
		$this->name            = $name;
		$this->label           = $label;
		$this->description     = $description;
		$this->options         = $options;
		$this->args            = $args;
		$this->hidden_property = $hidden_property;
		$this->hidden_values   = $hidden_values;
		add_filter( 'wellexpo_select_filter_taxonomy_fields', array( $this, 'addFieldForEditSave' ) );
	}
	
	public function addFieldForEditSave( $names ) {
		//for icon type of field add additonal icon font family based names for saving
		if ( $this->type == 'icon' ) {
			$icons_collections = wellexpo_select_icon_collections()->getIconCollectionsKeys();
			
			foreach ( $icons_collections as $icons_collection ) {
				$icons_param = wellexpo_select_icon_collections()->getIconCollectionParamNameByKey( $icons_collection );
				
				$names[] = $this->name . '_' . $icons_param;
			}
		}
		
		$names[] = $this->name;
		
		return $names;
	}
	
	public function render( $factory ) {
		$hidden = false;
		
		if ( isset( $_GET['tag_ID'] ) ) {
			if ( ! empty( $this->hidden_property ) ) {
				foreach ( $this->hidden_values as $value ) {
					if ( get_term_meta( $_GET['tag_ID'], $this->hidden_property, true ) == $value ) {
						$hidden = true;
					}
				}
			}
		}
		
		$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden );
	}
}

abstract class WellExpoSelectClassTaxonomyFieldType {
	abstract public function render( $name, $label = "", $description = "", $options = array(), $args = array() );
}

class WellExpoSelectClassTaxonomyFieldText extends WellExpoSelectClassTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {
		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
			<div class="form-field">
				<label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<input type="text" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" value="">
				<p class="description"><?php echo esc_html( $description ); ?></p>
			</div>
			<?php
		} else {
			$value = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
			<tr class="form-field" <?php if ($hidden) { ?> style="display: none"<?php } ?>>
				<th scope="row" valign="top">
					<label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				</th>
				<td>
					<input type="text" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" value="<?php echo esc_attr( $value ) ? esc_attr( $value ) : ''; ?>">
					<p class="description"><?php echo esc_html( $description ); ?></p>
				</td>
			</tr>
			<?php
		}
	}
}

class WellExpoSelectClassTaxonomyFieldImage extends WellExpoSelectClassTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
			<div class="form-field">
				<label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<input type="hidden" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" class="qodef-tax-custom-media-url" value="">
				<div class="qodef-tax-image-wrapper"></div>
				<p>
					<input type="button" class="button button-secondary qodef-tax-media-add" name="qodef-tax-media-add" value="<?php esc_attr_e( 'Add Image', 'wellexpo' ); ?>"/>
					<input type="button" class="button button-secondary qodef-tax-media-remove" name="qodef-tax-media-remove" value="<?php esc_attr_e( 'Remove Image', 'wellexpo' ); ?>"/>
				</p>
			</div>
			<?php
		} else {
			global $taxonomy;
			$image_id = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
			<tr class="form-field" <?php if ($hidden) { ?> style="display: none"<?php } ?>>
				<th scope="row">
					<label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				</th>
				<td>
					<?php ?>
					<input type="hidden" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" value="<?php echo esc_attr( $image_id ); ?>" class="qodef-tax-custom-media-url">
					<div class="qodef-tax-image-wrapper">
						<?php if ( $image_id ) { ?>
							<?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
						<?php } ?>
					</div>
					<p>
						<input type="button" class="button button-secondary qodef-tax-media-add" name="qodef-tax-media-add" value="<?php esc_attr_e( 'Add Image', 'wellexpo' ); ?>"/>
						<input data-termid="<?php echo esc_attr( $_GET['tag_ID'] ); ?>" data-taxonomy="<?php echo esc_attr( $taxonomy ); ?>" type="button" class="button button-secondary qodef-tax-media-remove" name="qodef-tax-media-remove" value="<?php esc_attr_e( 'Remove Image', 'wellexpo' ); ?>"/>
					</p>
				</td>
			</tr>
			<?php
		}
	}
}

class WellExpoSelectClassTaxonomyFieldSelect extends WellExpoSelectClassTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if(isset($args["dependence"])) {
			$dependence = true;
		}

		$show = array();
		if(isset($args["show"])) {
			$show = $args["show"];
		}

		$hide = array();
		if(isset($args["hide"])) {
			$hide = $args["hide"];
		}

		$select2 = '';
		if (isset($args['select2'])) {
			$select2 = 'qodef-select2';
		}

		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
			<div class="form-field">
				<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<select
                        class="<?php echo esc_attr($select2)?> form-control qodef-form-element<?php if ($dependence) { echo " dependence"; } ?>"
                        name="<?php echo esc_attr( $name ); ?>"
					<?php foreach($show as $key=>$value) { ?>
                        data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
					<?php } ?>
					<?php foreach($hide as $key=>$value) { ?>
                        data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
					<?php } ?>
                        id="<?php echo esc_attr( $name ); ?>">
					<?php if ( isset( $args['first_empty'] ) && $args['first_empty'] ) { ?>
						<option selected='selected' value=""></option>
					<?php } ?>
					<?php foreach ( $options as $key => $value ) {
						if ( $key == "-1" ) {
							$key = "";
						} ?>
						<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
					<?php } ?>
				</select>
				<p class="description"><?php echo esc_html( $description ); ?></p>
			</div>
			<?php
		} else {

			$selected_value = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
			<tr class="form-field" <?php if ($hidden) { ?> style="display: none"<?php } ?>>
				<th scope="row" valign="top">
					<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				</th>
				<td>
					<select name="<?php echo esc_attr( $name ); ?>"
                            class="<?php echo esc_attr($select2)?> qodef-form-element<?php if ($dependence) { echo " dependence"; } ?>"
						<?php foreach($show as $key=>$value) { ?>
                            data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
						<?php } ?>
						<?php foreach($hide as $key=>$value) { ?>
                            data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
						<?php } ?>
                            id="<?php echo esc_attr( $name ); ?>">
						<option <?php if ( $selected_value == "" ) { echo "selected='selected'"; } ?> value=""></option>
						<?php foreach ( $options as $key => $value ) {
							if ( $key == "-1" ) {
								$key = "";
							} ?>
							<option <?php if ( $selected_value == $key ) { echo "selected='selected'"; } ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
						<?php } ?>
					</select>
					<p class="description"><?php echo esc_html( $description ); ?></p>
				</td>
			</tr>
			<?php
		}
	}
}

class WellExpoSelectClassTaxonomyFieldIcon extends WellExpoSelectClassTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {
		$options           = wellexpo_select_icon_collections()->getIconCollectionsEmpty();
		$icons_collections = wellexpo_select_icon_collections()->getIconCollectionsKeys();
		
		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
			<div class="form-field">
				<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<select name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" class="dependence">
					<?php foreach ( $options as $option => $key ) { ?>
						<option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_attr( $key ); ?></option>
					<?php } ?>
				</select>
				<p class="description"><?php echo esc_html( $description ); ?></p>
			</div>
			<?php foreach ( $icons_collections as $icons_collection ) {
				$icons_param = wellexpo_select_icon_collections()->getIconCollectionParamNameByKey( $icons_collection );
				?>
				<div class="form-field qode-icon-collection-holder" style="display: none" data-icon-collection="<?php echo esc_attr( $icons_collection ); ?>">
					<label for="<?php echo esc_attr( $name ) . '_icon'; ?>"><?php esc_html_e( 'Icon', 'wellexpo' ); ?></label>
					<select name="<?php echo esc_attr( $name . '_' . $icons_param ) ?>" id="<?php echo esc_attr( $name . '_' . $icons_param ) ?>">
						<?php
						$icons = wellexpo_select_icon_collections()->getIconCollection( $icons_collection );
						foreach ( $icons->icons as $option => $key ) { ?>
							<option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_attr( $key ); ?></option>
						<?php } ?>
					</select>
				</div>
			<?php } ?>
			<?php
		} else {
			$icon_pack = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
			<tr class="form-field" <?php if ($hidden) { ?> style="display: none"<?php } ?>>
				<th scope="row">
					<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				</th>
				<td>
					<select name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" class="dependence">
						<?php foreach ( $options as $option => $key ) { ?>
							<option value="<?php echo esc_attr( $option ); ?>" <?php if ( $option == $icon_pack ) { echo 'selected'; } ?>><?php echo esc_attr( $key ); ?></option>
						<?php } ?>
					</select>
					<p class="description"><?php echo esc_html( $description ); ?></p>
				</td>
			</tr>
			<?php foreach ( $icons_collections as $icons_collection ) {
				$icons_param = wellexpo_select_icon_collections()->getIconCollectionParamNameByKey( $icons_collection );
				$style       = 'display:none';
				if ( $icon_pack == $icons_collection ) {
					$style = 'display:table-row';
				}
				?>
				<tr class="form-field qode-icon-collection-holder" style="<?php echo esc_attr( $style ); ?>" data-icon-collection="<?php echo esc_attr( $icons_collection ); ?>">
					<th scope="row"><?php esc_html_e( 'Icon', 'wellexpo' ); ?></th>
					<td>
						<select name="<?php echo esc_attr( $name . '_' . $icons_param ) ?>" id="<?php echo esc_attr( $name . '_' . $icons_param ) ?>">
							<?php
							$icons      = wellexpo_select_icon_collections()->getIconCollection( $icons_collection );
							$activ_icon = get_term_meta( $_GET['tag_ID'], $name . '_' . $icons_param, true );
							foreach ( $icons->icons as $option => $key ) { ?>
								<option value="<?php echo esc_attr( $option ); ?>" <?php if ( $option == $activ_icon ) { echo 'selected'; } ?>><?php echo esc_attr( $key ); ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			<?php } ?>
			<?php
		}
	}
}

class WellExpoSelectClassTaxonomyFieldColor extends WellExpoSelectClassTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {
		
		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
			<div class="form-field">
				<label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				<input type="text" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" value="" class="qodef-taxonomy-color-field">
				<p class="description"><?php echo esc_html( $description ); ?></p>
			</div>
			<?php
		} else {
			$value = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
			<tr class="form-field" <?php if ($hidden) { ?> style="display: none"<?php } ?>>
				<th scope="row" valign="top">
					<label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
				</th>
				<td>
					<input type="text" name="<?php echo esc_html( $name ); ?>" id="<?php echo esc_html( $name ); ?>" value="<?php echo esc_attr( $value ) ? esc_attr( $value ) : ''; ?>" class="qodef-taxonomy-color-field">
					<p class="description"><?php echo esc_html( $description ); ?></p>
				</td>
			</tr>
			<?php
		}
	}
}

class WellExpoSelectClassTaxonomyFieldFactory {
	public function render( $field_type, $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {
		
		switch ( strtolower( $field_type ) ) {
			case 'text':
				$field = new WellExpoSelectClassTaxonomyFieldText();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			
			case 'image':
				$field = new WellExpoSelectClassTaxonomyFieldImage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			
			case 'selectblank':
				$field = new WellExpoSelectClassTaxonomyFieldSelect();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			
			case 'icon':
				$field = new WellExpoSelectClassTaxonomyFieldIcon();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			
			case 'color':
				$field = new WellExpoSelectClassTaxonomyFieldColor();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			
			default:
				break;
		}
	}
}
