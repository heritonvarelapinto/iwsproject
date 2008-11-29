<?php
	class LayoutAdministracao extends AdministracaoHTML  {
		public function EstruturaAdministracao($acao) {
			switch ($acao) {
				case "mostra":
					$this->AdministracaoMostra("Verificar Usuários");
				break;
				case "add":
					$this->AdministracaoADD("Criar Usuários","return valida_usuario();","act/Administracao.act.php?acao=add","usuario","post");
				break;
				case "altera":
					$this->AdministracaoALT("Alterar Usuário","return valida_altusuario();","act/Administracao.act.php?acao=alt","altusuario","post");
				break;
			}
		}
	}
?>