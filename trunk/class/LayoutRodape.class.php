<?php
	class LayoutRodape extends RodapeHTML {
		public function EstruturaRodape($acao) {
			if(strlen($acao) > 2) {
				switch ($acao) {
					case "uso":
						$this->RodapePoliticaDeUso();
					break;
					case "privacidade":
						$this->RodapePoliticaDePrivacidade();
					break;
					case "contato":
						$this->RodapeContato();
					break;
					case "add":
						$this->RodapeADD();
					break;
				}
			}else{
				$this->Rodape($acao);
			}
		}
	}
?>