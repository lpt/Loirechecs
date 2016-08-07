Problème suite validator du form 
* @Assert\NotBlank(message="Uploader une image")
     * @Assert\File(mimeTypes={ "image/*" })
		 
* @Assert\NotBlank(message="Uploader un resultat en html")
     * @Assert\File(mimeTypes={ "text/html" })
		 
 * @Assert\NotBlank(message="Uploader un pdf")
     * @Assert\File(mimeTypes={ "application/pdf" })
		 
Champs requis  pour adresse
