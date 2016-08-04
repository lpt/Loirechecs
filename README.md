Loirechecs
==========

A Symfony project created on June 28, 2016, 12:50 pm.

=======================================================

Cahier des charges réduit:
--------------------------

le site démarre sur une page de liste de news avec sur le côté les prochains évenments.

On peut visualiser une news, des tournois  (affiche, déscription, résultats,...),  un calendrier et l'exporter en pdf

On peut aussi visualiser  des pages d'informations diverses.

La barre de navigation se construit en fonction des tournois et agenda.


Contenu:
--------

le fichier src comprendra un bundle principal (GACoreBundle) et un Bundle pour la gestion des utilisateurs

GACoreBundle contiendra les contrôleurs(/conttoleur):

		StaticController charge des pages statiques.
	
		TournoiController gère les tournois.
		
		AnnonceController gère les annonces. (indexAction() est l'entrée du site)
		
		AgendaController  gére le calendrier.
		
		
		
GACoreBundle contiendra les vues et les différents layout (/Ressources/views) avec le template twig



GACoreBundle contiendra les modèles gérer par l'ORM Doctrine 2:

		/Entity contiendra les objets qui représente les différentes tables
	
		/Respository contiendra les méthodes personalisé des modèles
		

GAUserBundle? contiendra la gestion des utilisateurs, leur modèles et leur vue et la relation de sécurité avec symfony pour l'authentification et les autorisations

Note: 

un event.listener doctrine pour l' upload
une extension Twig
