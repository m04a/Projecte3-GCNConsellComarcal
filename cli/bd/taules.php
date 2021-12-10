<?php
/*Crea totes les taules de la base de dades que necessita l'aplicació per funcionar*/
$connexio->query("CREATE TABLE usuari (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    nom VARCHAR(150),
    cognom VARCHAR(150),
    username VARCHAR(150) UNIQUE,
    contrasenya VARCHAR(50),
    rol VARCHAR(150) DEFAULT 'Usuari',
    email VARCHAR(150), 
    telefon VARCHAR(15), 
    PRIMARY KEY (id)
);");

$connexio->query("CREATE TABLE categoria (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    nom VARCHAR(150),
    id_usuari BIGINT UNSIGNED, 
    data_creacio TIMESTAMP, 
    CONSTRAINT fk_usuariCat FOREIGN KEY (id_usuari) REFERENCES usuari(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    PRIMARY KEY (id)
);");

$connexio->query("CREATE TABLE article (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    titol VARCHAR(150),
    contingut TEXT,
    publicat INT(1) DEFAULT 0, 
    imatge VARCHAR(100) DEFAULT 'img/articles/logo2.png', 
    id_categoria BIGINT UNSIGNED,
    id_usuari BIGINT UNSIGNED, 
    data_creacio TIMESTAMP, 
    CONSTRAINT fk_categoriaArt FOREIGN KEY (id_categoria) REFERENCES categoria(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    CONSTRAINT fk_usuariArt FOREIGN KEY (id_usuari) REFERENCES usuari(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    PRIMARY KEY (id)
);");

$connexio->query("CREATE TABLE usuari_categoria_edita (
    id_usuari BIGINT UNSIGNED,
    id_categoria BIGINT UNSIGNED, 
    data_edicio TIMESTAMP, 
    nom VARCHAR(150),
    CONSTRAINT fk_usuariEditaCat FOREIGN KEY (id_usuari) REFERENCES usuari(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    CONSTRAINT fk_categoriaEditaUser FOREIGN KEY (id_categoria) REFERENCES categoria(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    PRIMARY KEY (id_usuari, id_categoria, data_edicio)
);");

$connexio->query("CREATE TABLE usuari_article_edita (
    id_usuari BIGINT UNSIGNED,
    id_article BIGINT UNSIGNED, 
    data_edicio TIMESTAMP, 
    titol VARCHAR(150),
    contingut TEXT,
    imatge VARCHAR(100) DEFAULT 'img/articles/logo2.png', 
    CONSTRAINT fk_usuariEditaArt FOREIGN KEY (id_usuari) REFERENCES usuari(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    CONSTRAINT fk_articleEditaUser FOREIGN KEY (id_article) REFERENCES article(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    PRIMARY KEY (id_usuari, id_article, data_edicio)
);");

$connexio->query("CREATE TABLE document (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    enllac VARCHAR(255),
    id_article BIGINT UNSIGNED, 
    CONSTRAINT fk_articleDocument FOREIGN KEY (id_article) REFERENCES article(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    PRIMARY KEY (id)
);");

$connexio->query("CREATE TABLE contacte (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    missatge TEXT, 
    id_usuari BIGINT UNSIGNED, 
    data_creacio TIMESTAMP, 
    CONSTRAINT fk_usuariMsg FOREIGN KEY (id_usuari) REFERENCES usuari(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    PRIMARY KEY (id)
);");

$connexio->query("CREATE TABLE articles_favorits (
    id_article BIGINT UNSIGNED,  
    id_usuari BIGINT UNSIGNED, 
    CONSTRAINT fk_usuari_favorit FOREIGN KEY (id_usuari) REFERENCES usuari(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    CONSTRAINT fk_article_favorit FOREIGN KEY (id_article) REFERENCES article(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    PRIMARY KEY (id_article, id_usuari)
);");