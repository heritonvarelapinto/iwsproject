<?php
	class LayoutBanner extends BannerHTML  {
		public function EstruturaBanner($acao) {
			switch ($acao) {
				case "mostra":
					$this->BannerMostra("Verificar Banners");
				break;
				case "add":
					$this->ADDALTBanner();
				break;
				case "altera":
					//$this->AdministracaoALT("Alterar Usuário","return valida_altusuario();","act/Administracao.act.php?acao=alt","altusuario","post");
				break;
			}
		}
	}
?>