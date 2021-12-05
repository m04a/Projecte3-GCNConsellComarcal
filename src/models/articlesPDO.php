<?php
/**
 * Classe que gestiona la gestio dels articles
 * **/

/**
 * Article PDO: Classe que gestiona la gestio d'articles
 * 
 * Sera la classe que servira per esborrar, crear, modificar els articles de l'aplicació
 * **/
class ArticlesPDO extends ModelPDO
{
    private $taula = "article";

    /**
     * gettotalregistres: Mostra el numero total de articles
     **/
 public function gettotalregistres()
    {
        $article = parent::totalregistres($this->taula);

        return $article;
    }

    /**
     * getllistat: Mostra tots els articles
     **/
    public function getllistat()
    {
        $articles = parent::llistat($this->taula);

        return $articles;
    }

    public function getArrayValorsPredefinits($usuariLogat)
    {
        $arrayPredefinit = array('Nou Article', '<h1 style="text-align: center;">Article de prova</h1>	',0,$usuariLogat);;

        return $arrayPredefinit;
    }
      /**
     * delete: esborra un article amb l'id especificat per parametre de la base de dades
     * @param id id de l'article a borrar
     **/
    public function delete($id)
    {
        $taula2 = $this->taula;

        $query = "delete from $taula2 where id = :id;";
        $stm = $this->sql->prepare($query);
        $result = $stm->execute([':id' => $id]);

        if ($stm->errorCode() !== '00000') {
            $err = $stm->errorInfo();
            $code = $stm->errorCode();
            die("Error.   {$err[0]} - {$err[1]}\n{$err[2]} $query");
        }

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }
    public function show($id)
    {
        $taula2 = $this->taula;

        $query = "select * from $taula2 where id = :id LIMIT 1;";
        $stm = $this->sql->prepare($query);
        $result = $stm->execute([':id' => $id]);

        if ($stm->errorCode() !== '00000') {
            $err = $stm->errorInfo();
            $code = $stm->errorCode();
            die("Error.   {$err[0]} - {$err[1]}\n{$err[2]} $query");
        }

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }
     /**
     * update: modificara els dades d'usuari registrat a la base de dades
     * @param id id de l'usuari a modificar
     * @param nom nom de l'usuari
     * @param cognom cognom de l'usuari
     * @param username nom que fara servir l'usuari per fer login
     * @param rol rol de l'usuari
     * @param email correu electronic de l'usuari
     * @param telefon telefon de l'usuari
     **/
    public function update($id, $contingut, $titol,$publicat)
    {
        $taula2 = $this->taula;

        $query = "update $taula2 set contingut = :contingut,titol = :titol,publicat = :publicat where id = :id;";
        $stm = $this->sql->prepare($query);
        $result = $stm->execute([':id' => $id,':contingut' => $contingut, ':titol' => $titol,':publicat' => $publicat]);

        if ($stm->errorCode() !== '00000') {
            $err = $stm->errorInfo();
            $code = $stm->errorCode();
            die("Error.   {$err[0]} - {$err[1]}\n{$err[2]} $query");
        }

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }
    public function getAlert($id){
        if ($id == 'faltacamp'){
            $id = 'Introdueix tots els camps abans de enviar les dades';
        }
        return $id;
    }
}
