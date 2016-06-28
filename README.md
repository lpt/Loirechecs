Loirechecs
==========

A Symfony project created on June 28, 2016, 12:50 pm.

=======================================================

Cahier des charges réduit:
--------------------------

le site démarre sur une page de liste de news avec sur le côté les prochains évenments.

On peut visualiser une news, des tournois  (affiche, déscription, résultats,...),  un calendrier et l'exporter en pdf

On peut aussi visualiser  des pages d'informations écrit en dur.


Contenu:
--------

le fichier src comprendra un bundle principal (GACoreBundle) et un Bundle pour la gestion des utilisateurs

GACoreBundle contiendra les contrôleurs(/conttoleur):

		StaticController chargera des pages statiques.
	
		MonoController gérera les  tournois mono journée.
		
		MultiController gérera les tournois multi journées.
		
		AnnonceController gérera le système d'annonce. (indexAction() est l'entrée du site)
		
		AgendaController  gérera le calendrier.
		
		
		
GACoreBundle contiendra les vues et les différents layout (/Ressources/views) avec le template twig



GACoreBundle contiendra les modèles gérer par l'ORM Doctrine 2:

		/Entity contiendra les objets qui représente les différentes tables
	
		/Respository contiendra les méthodes personalisé des modèles
		

GAUserBundle? contiendra la gestion des utilisateurs, leur modèles et leur vue et la relation de sécurité avec symfony pour l'authentification et les autorisations
