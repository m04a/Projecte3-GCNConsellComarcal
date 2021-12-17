<?php

function ctrlArticle($peticio, $resposta, $contenidor)
{
    $articlesPDO = $contenidor->articlesPDO();

    $idarticle = $peticio->get(INPUT_GET, "id");

    $informacioArticle = $articlesPDO->getInfoArticle($idarticle);

    $documentsArticle = $articlesPDO->getDocumentsArticle($idarticle);
    
    
    $seguentArticle = $articlesPDO->obtenirSeguentArticle($idarticle);

    $idseguentArticle = $seguentArticle['id'];

    $nomseguentArticle = $seguentArticle['titol'];

    $anteriorArticle = $articlesPDO->obtenirAnteriorArticle($idarticle);

    $idanteriorArticle = $anteriorArticle['id'];

    $nomanteriorArticle = $anteriorArticle['titol'];

    $resposta->set('idseguentArticle', $idseguentArticle);
    $resposta->set('nomseguentArticle', $nomseguentArticle);
    $resposta->set('idanteriorArticle', $idanteriorArticle);
    $resposta->set('nomanteriorArticle', $nomanteriorArticle);
    $resposta->set('informacioArticle', $informacioArticle);
    $resposta->set('documentsArticle', $documentsArticle);

    $resposta->SetTemplate("article.php");

    return $resposta;
}