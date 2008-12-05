<?php
	class LayoutEnquete extends EnqueteHTML {
		public function EstruturaEnquete($acao) {
			switch ($acao) {
				case "mostra":
					$this->EnquetesMostra(10);
				break;
			}
		}
	}
?>