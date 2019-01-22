<?php

/**
 * Class Jetpack_Sync_Test_Helper
 *
 * Provides utilities and hooks needed for testing
 */

class Jetpack_Sync_Test_Helper {
	public $array_override;
	private $actions;

	public function filter_override_array() {
		return $this->array_override;
	}

	public function filter_to_check( $action, $priority = 10, $args = 1 ) {
		add_action( $action, array( $this, 'call_filter' ), $priority, $args );
	}

	public function call_filter( $value ) {
		$action = current_action();
		if ( ! isset( $this->actions[ $action ] ) ) {
			$this->actions[ $action ] = 1;
		} else {
			$this->actions[ $action ]++;
		}
		return $value;
	}

	public function filter_was_called( $action ) {
		return isset( $this->actions[ $action ] );
	}
}

