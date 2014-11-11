<?php

/**
 * CakePHP CustomUtilComponent
 * @author thanhtr
 */
class CustomUtilComponent extends Component {

	public $components = ['Session'];

	public function flash($message, $type = 'error') {
		if (!empty($message)) {
			switch ($type) {
				case 'error':
					$this->Session->setFlash($message, 'alerts/alert_error', null, 'notify');
					break;
				case 'warning':
					$this->Session->setFlash($message, 'alerts/alert_warning', null, 'notify');
					break;
				case 'success':
					$this->Session->setFlash($message, 'alerts/alert_success', null, 'notify');
					break;
				default:
					$this->Session->setFlash($message, 'alerts/alert_error', null, 'notify');
					break;
			}
		}
	}

}
