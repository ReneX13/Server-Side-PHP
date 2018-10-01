<?php
	class User{
		public $username = "default";
		private $pin = "4789";
		private $admin = false;	
		
		function User( $u, $p){
			$this->username = $u;
			$this->pin = $p;
			$this->message = "Hello World";
		}

		function setPinAndAdmin($p, $a){
			$this->pin = $p;
			$this->admin = $a;
		}
		
		function setPin($p){
			$this->pin = $p;
		}
		function setAdmin($a){
			$this->admin = $a;
		}
		function getPin(){	
			return $this->pin;
		}

		function getAdmin(){
			return $this->admin;
		}
			
	}
	

?>
