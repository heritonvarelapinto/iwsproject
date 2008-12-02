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
			}
		}
	}
?>