#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        User_ID            Char (9) NOT NULL ,
        User_pseudo        Char (20) ,
        User_Mdp           Char (20) ,
        User_DateCreation  Date ,
        User_Favoris       Char (50) ,
        User_Rank          Char (50) ,
        User_sexe          Bool ,
        User_DateNaissance Date ,
        User_nom           Char (25) ,
        Prenium_ID         Int ,
        PRIMARY KEY (User_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Musique
#------------------------------------------------------------

CREATE TABLE Musique(
        Musique_ID        Int NOT NULL ,
        Musique_Paroles   Bool ,
        Musique_Duree     Int ,
        Musique_Titre     Char (50) ,
        Musique_NbEcoutes Int ,
        Musique_Nom       Char (80) ,
        Musique_Ecoutee   Bool ,
        PRIMARY KEY (Musique_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Artiste
#------------------------------------------------------------

CREATE TABLE Artiste(
        Artiste_ID     Char (100) NOT NULL ,
        Artiste_Genre  Char (20) ,
        Artiste_Nom    Varchar (50) ,
        Artiste_Prenom Varchar (50) ,
        PRIMARY KEY (Artiste_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Album
#------------------------------------------------------------

CREATE TABLE Album(
        Album_ID            Int NOT NULL ,
        Album_Nom           Char (80) ,
        Album_NbTitres      Int ,
        Album_Disponibilite Bool ,
        Album_Date          Date ,
        Quantite            Int ,
        Artiste_ID          Char (100) ,
        PRIMARY KEY (Album_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Playlist
#------------------------------------------------------------

CREATE TABLE Playlist(
        Playlist_ID   Int NOT NULL ,
        Playlist_Nom  Char (50) ,
        Playlist_Date Date ,
        User_ID       Char (9) ,
        PRIMARY KEY (Playlist_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: UserPremium
#------------------------------------------------------------

CREATE TABLE UserPremium(
        Prenium_ID       Int NOT NULL ,
        Premium          Bool ,
        Premium_duration Float ,
        User_ID          Char (9) ,
        PRIMARY KEY (Prenium_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Label
#------------------------------------------------------------

CREATE TABLE Label(
        Label_Nom Varchar (50) NOT NULL ,
        PRIMARY KEY (Label_Nom )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Genre
#------------------------------------------------------------

CREATE TABLE Genre(
        Genre_Nom Varchar (50) NOT NULL ,
        PRIMARY KEY (Genre_Nom )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Composer
#------------------------------------------------------------

CREATE TABLE Composer(
        Quantite   Int ,
        Musique_ID Int NOT NULL ,
        Album_ID   Int NOT NULL ,
        PRIMARY KEY (Musique_ID ,Album_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Contenir
#------------------------------------------------------------

CREATE TABLE Contenir(
        Quantite    Int ,
        Playlist_ID Int NOT NULL ,
        Musique_ID  Int NOT NULL ,
        PRIMARY KEY (Playlist_ID ,Musique_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Avoir
#------------------------------------------------------------

CREATE TABLE Avoir(
        Label_Nom Varchar (50) NOT NULL ,
        Album_ID  Int NOT NULL ,
        PRIMARY KEY (Label_Nom ,Album_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Correspond
#------------------------------------------------------------

CREATE TABLE Correspond(
        Artiste_ID Char (100) NOT NULL ,
        Genre_Nom  Varchar (50) NOT NULL ,
        PRIMARY KEY (Artiste_ID ,Genre_Nom )
)ENGINE=InnoDB;

ALTER TABLE User ADD CONSTRAINT FK_User_Prenium_ID FOREIGN KEY (Prenium_ID) REFERENCES UserPremium(Prenium_ID);
ALTER TABLE Album ADD CONSTRAINT FK_Album_Artiste_ID FOREIGN KEY (Artiste_ID) REFERENCES Artiste(Artiste_ID);
ALTER TABLE Playlist ADD CONSTRAINT FK_Playlist_User_ID FOREIGN KEY (User_ID) REFERENCES User(User_ID);
ALTER TABLE UserPremium ADD CONSTRAINT FK_UserPremium_User_ID FOREIGN KEY (User_ID) REFERENCES User(User_ID);
ALTER TABLE Composer ADD CONSTRAINT FK_Composer_Musique_ID FOREIGN KEY (Musique_ID) REFERENCES Musique(Musique_ID);
ALTER TABLE Composer ADD CONSTRAINT FK_Composer_Album_ID FOREIGN KEY (Album_ID) REFERENCES Album(Album_ID);
ALTER TABLE Contenir ADD CONSTRAINT FK_Contenir_Playlist_ID FOREIGN KEY (Playlist_ID) REFERENCES Playlist(Playlist_ID);
ALTER TABLE Contenir ADD CONSTRAINT FK_Contenir_Musique_ID FOREIGN KEY (Musique_ID) REFERENCES Musique(Musique_ID);
ALTER TABLE Avoir ADD CONSTRAINT FK_Avoir_Label_Nom FOREIGN KEY (Label_Nom) REFERENCES Label(Label_Nom);
ALTER TABLE Avoir ADD CONSTRAINT FK_Avoir_Album_ID FOREIGN KEY (Album_ID) REFERENCES Album(Album_ID);
ALTER TABLE Correspond ADD CONSTRAINT FK_Correspond_Artiste_ID FOREIGN KEY (Artiste_ID) REFERENCES Artiste(Artiste_ID);
ALTER TABLE Correspond ADD CONSTRAINT FK_Correspond_Genre_Nom FOREIGN KEY (Genre_Nom) REFERENCES Genre(Genre_Nom);
