<?php
	class LayoutInformativo extends InformativoHTML {
		public function EstruturaInformativo($acao) {
			switch ($acao) {
				case "mostra":
					$this->InformativoMostra(20);
				break;
				case "add":
				break;
				case "criar":
				break;
				case "enviar":
				break;
				case "modelos":
				break;
			}
		}
	}
?>