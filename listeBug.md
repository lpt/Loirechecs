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

-controlleur annnonce:

				- ajout des ressources

				- ajout d'une annonce tournoi existant :
																		
																-  inscription interne (non prioritaire)
																
																-  amélioration 
																
				- ajout d'une annonce evenement auto (publi auto agenda true)
				
-creer l'entité agenda:

- controlleur agenda:

					- ajout d'un evenement
					
					- recuperation et construction d'un evenement
					
					- liste des evenement
					
					- creation PDF
					
					- bug d'affichage nav
								

-page erreur

- bundle user : 

					- mise en forme des pages
					
					- affectation des droits


				