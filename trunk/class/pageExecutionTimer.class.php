<?php
class pageExecutionTimer {

    private $executionTime;

    public function __construct()

    {

        $this->executionTime = microtime(true);

    }

    public function __destruct()

    {

      echo '<table width="400" cellspacing="1" cellpadding="4" border="0" class="BordaTabela"><tr class="Linha2Tabela"><td height="20"><b>Tempo de execução:</b></td><td width="40%" height="20">'.substr((microtime(true)-$this->executionTime),0,7).'</td></tr></table>';

    }

}

?>