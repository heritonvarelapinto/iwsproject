<?php
	class LayoutInformativo extends InformativoHTML {
		public function EstruturaInformativo($acao) {
			switch ($acao) {
				case "mostra":
					$this->InformativoMostra(20);
				break;
				case "add":
					if(isset($_GET["menos"])) {
						$this->InfomativoEmailsADD();
						$this->EmailsTotal($_GET["menos"],$_GET["n"],$_GET["total"]);
					}else{
						$this->InfomativoEmailsADD();
					}
				break;
				case "criar":
					$this->InformativoModeloCriar();
				break;
				case "enviar":
				break;
				case "modelos":
					
				break;
			}
		}
	}
?>