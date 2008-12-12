<?php
	class LayoutAnuncio extends AnuncioHTML {
		public function EstruturaAnuncio($acao) {
			switch ($acao) {
				case "add":
					$this->AnuncioADD();
				break;
				case "mostra":
					$this->AnuncioMostra();
				break;
			}
		}
	}
?>