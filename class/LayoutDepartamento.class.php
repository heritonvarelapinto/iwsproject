<?php
	class LayoutDepartamento extends DepartamentoHTML {
		public function EstruturaDepartamento($acao) {
			switch ($acao) {
				case "mostra":
					$this->DepartamentoMostra("Verificar Departamentos");
				break;
				case "adddep":
					$this->DepartamentoADD();
				break;
				case "altdep":
					$this->DepartamentoALT();
				break;
			}
		}
	}
?>