Listes des Bugs
***************

-Problème suite validator du form 
* @Assert\NotBlank(message="Uploader une image")
     * @Assert\File(mimeTypes={ "image/*" })
		 
* @Assert\NotBlank(message="Uploader un resultat en html")
     * @Assert\File(mimeTypes={ "text/html" })
		 
 * @Assert\NotBlank(message="Uploader un pdf")
     * @Assert\File(mimeTypes={ "application/pdf" })
		 		 
-Champs requis  sur variable non requise  pour adresse et autres


Listes des taches
***************

-controlleur tournoi:

				-convertir paramètre de requête pour le tournoiControlleur

-modifier l'entité annonce:
					
				- Relation lien , image, resulat, affiche

-controlleur annnonce:

				- ajout des ressources

				- ajout d'une annonce tournoi existant :
				
																-  inscription : 
																
																-  inscription interne (non prioritaire)
																
																-  resultat : 
																
																- evenement manuel (publi auto agenda false)
																
				- recupération des ressources tournois (coche publier)
					
				- ajout d'une annonce divers (divers + tournoi non existant)
					
				- ajout d'une annonce evenement auto (publi auto agenda true)
				
				
				
-creer l'entité agenda:

- controlleur agenda:

					- ajout d'un evenement
					
					- recuperation et construction d'un evenement
					
					- liste des evenement
					
					- creation PDF
								

-page erreur

- bundle user : 

					- mise en forme des pages
					
					- affectation des droits


				