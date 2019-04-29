<?php
/**
 * Base class for all input blocks.
 *
 * @author alex
 */
abstract class Mondula_Form_Wizard_Block {

	public function generate_id( $ids ) {
		$result = 'fw';
		foreach ( $ids as $id ) {
			$result .= '-' . $id;
		}
		return $result;
	}

	abstract function render( $ids );

	public static function from_aa( $block, $current_version, $serialized_version ) {
		switch ( $block['type'] ) {
			case 'radio':
				return Mondula_Form_Wizard_Block_Radio::from_aa( $block, $current_version, $serialized_version );
				break;
			case 'select':
				return Mondula_Form_Wizard_Block_Select::from_aa( $block, $current_version, $serialized_version );
				break;
			case 'text':
				return Mondula_Form_Wizard_Block_Text::from_aa( $block, $current_version, $serialized_version );
				break;
			case 'textarea':
				return Mondula_Form_Wizard_Block_Textarea::from_aa( $block, $current_version, $serialized_version );
				break;
			case 'email':
				return Mondula_Form_Wizard_Block_Email::from_aa( $block, $current_version, $serialized_version );
				break;
			case 'numeric':
				return Mondula_Form_Wizard_Block_Numeric::from_aa( $block, $current_version, $serialized_version );
				break;
			case 'file':
				return Mondula_Form_Wizard_Block_File::from_aa( $block, $current_version, $serialized_version );
				break;
			case 'date':
				return Mondula_Form_Wizard_Block_Date::from_aa( $block, $current_version, $serialized_version );
				break;
			case 'paragraph':
				return Mondula_Form_Wizard_Block_Paragraph::from_aa( $block, $current_version, $serialized_version );
				break;
			case 'regex':
				if ( class_exists( 'Multi_Step_Form_Plus' ) ) {
					return Multi_Step_Form_Plus_Block_Regex::from_aa( $block, $current_version, $serialized_version );
				}
				break;
			case 'registration':
				if ( class_exists( 'Multi_Step_Form_Plus' ) ) {
					return Multi_Step_Form_Plus_Block_Registration::from_aa( $block, $current_version, $serialized_version );
				}
				break;
			case 'conditional':
				if ( class_exists( 'Multi_Step_Form_Plus' ) ) {
					return Multi_Step_Form_Plus_Block_Conditional::from_aa( $block, $current_version, $serialized_version );
				}
				break;
			default:
				break;
		}
		return null;
	}
}
