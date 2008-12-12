<?php
	class LayoutAnuncio extends AnuncioHTML {
		public function EstruturaAnuncio($acao) {
			switch ($acao) {
				case "mostra":
					$this->AnuncioMostra();
				break;
			}
		}
	}
?>