<?
class Contato {
    public $idcontato;
    public $email;

    function getIdcontato() {
          return $this->idcontato;
    }
    function setIdcontato($idcontatoIn) {
          $this->idcontato = $idcontatoIn;
    }

    function getEmail() {
          return $this->email;
    }
    function setEmail($emailIn) {
          $this->email = $emailIn;
    }
}
?>