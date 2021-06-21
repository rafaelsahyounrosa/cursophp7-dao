<?php

class Usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIDusuario(){
        return $this->idusuario;
    }
    public function setIDusuario($value){
        $this->idusuario = $value;
    }
/////////////////////////////////////////////////////////
    public function getDeslogin(){
        return $this->deslogin;
    }
    public function setDeslogin($value){
        $this->deslogin = $value;
    }
/////////////////////////////////////////////////////////
    public function getDessenha(){
        return $this->dessenha;
    }
    public function setDessenha($value){
        $this->dessenha = $value;
    }
/////////////////////////////////////////////////////////
    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }
/////////////////////////////////////////////////////////

    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios where idusuario = :ID", array(
            ":ID"=>$id
        ));
        if (count($results) > 0 ){
           
            $this->setData($results[0]);
        }
    }

    public static function getList(){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios order by deslogin;"); 
    }

    public static function search($login){

        $sql = new Sql();
        return $sql->select("SELECT * From tb_usuarios where deslogin like :SEARCH order by deslogin", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login($loginuser, $passworduser){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios where deslogin = :LOGINUSER and dessenha - :PASSWORDUSER", array(
            ":LOGINUSER"=>$loginuser,
            ":PASSWORDUSER"=>$passworduser
        ));
        if (count($results) > 0 ){

            $this->setData($results[0]);
        } else {
            throw new Exception("Login não encontrado");
            
        }
    }

	public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));

    }

    public function insert(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));
        if (count($results) > 0){
            $this->setData($results[0]);
        }
    }

    public function update($login, $password){

		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();

		$sql->execQuery("UPDATE tb_usuarios SET deslogin = :LOGINUSER, dessenha = :PASSWORDUSER WHERE idusuario = :IDUSER", array(
			':LOGINUSER'=>$this->getDeslogin(),
			':PASSWORDUSER'=>$this->getDessenha(),
			':IDUSER'=>$this->getIDusuario()
		));
    }
    public function __construct($login = "", $password = ""){
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

	public function delete(){

		$sql = new Sql();

		$sql->execQuery("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdusuario()
		));

		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());

	}

    public function __toString(){
        return json_encode(array(

            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")

        ));

    }
}

?>