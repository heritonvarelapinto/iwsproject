<?php
	class LayoutAnuncio extends AnuncioHTML {
		public function EstruturaAnuncio($acao) {
			switch ($acao) {
				case "add":
					$this->AnuncioADD();
				break;
				case "alt":
					$this->AnuncioALT();
				break;
				case "mostra":
					$this->AnuncioMostra(20);
				break;
			}
		}
	}
?>