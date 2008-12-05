<?php
	class LayoutEnquete extends EnqueteHTML {
		public function EstruturaEnquete($acao) {
			switch ($acao) {
				case "mostra":
					$this->EnquetesMostra(10);
				break;
				case "add":
					$this->EnqueteADDPerg();
				break;
				case "addresp":
					$this->EnqueteADDResp();
				break;
			}
		}
	}
?>