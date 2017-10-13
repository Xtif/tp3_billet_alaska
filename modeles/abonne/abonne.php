<?php

class Abonne {

	public $id;
	public $email;

	public function __construct(array $data = array()) {
		$this->set_id($data['id']);
		$this->set_email($data['email']);	
	}

	/**********SETTERS***********/
	public function set_id($id) {
		$this->id = $id;
	}

	public function set_email($email) {
		$this->email = $email;
	}


	/*********GETTER************/
	public function get_id() {
		return $this->id;
	}

	public function get_email() {
		return $this->email;
	}

}

?>