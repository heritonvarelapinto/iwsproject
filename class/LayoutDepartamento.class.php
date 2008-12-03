<?php
	class LayoutDepartamento extends DepartamentoHTML {
		public function EstruturaDepartamento($acao) {
			switch ($acao) {
				//departamentos
				case "mostra":
					$this->DepartamentoMostra("Verificar Departamentos");
				break;
				case "adddep":
					$this->DepartamentoADD();
				break;
				case "altdep":
					$this->DepartamentoALT();
				break;
				//subdepartamentos
				case "addsub":
					$subdepartamentoHTML = new SubdepartamentoHTML();
					$iddepartamento = $_POST["iddepartamento"];
					$subdepartamentoHTML->SubdepartamentoADD($iddepartamento);
				break;
				case "altsub":
					$subdepartamentoHTML = new SubdepartamentoHTML();
					$subdepartamentoHTML->SubdepartamentoALT();
				break;
			}
		}
	}
?>