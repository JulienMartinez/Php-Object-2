TP Projet Site Web Toy'R'Us

Int�grer exactement comme sur la maquette.

La BDD contient:
- "brands": Marques
- "sales": Ventes par jouet et par date
- "stock": Stock disponible par jouet et par magasin
- "stores": Magasin
- "toys": Jouets (Nom, description, id marque, prix, nom du fichier de l'image)

Le site se compose de 3 pages:
- Accueil: Top 3 des meilleures ventes de l'ann�e en cours.
- Liste: Liste des jouets avec filtre par marque.
- D�tail: D�tail d'un jouet particulier.

Images des jouets:
A stocker dans un dossier d�di� (nom au choix).

Menus:
- "Tous les jouets": Lien vers liste compl�te.
- "Par marque": Sous-menu construit � partir de la BDD avec liens vers la page de liste pr�filtr�e sur la marque choisie.

D�tail:
- Information basiques du jouet
- Stock total, avec possibilit� de choisir un magasin pour affiner ce chiffre.


BONUS (� faire si tout est termin�):
- Responsive pour mobile (� imaginer)
- Dans le sous-menu, afficher le nombre de jouets diff�rents pour chaque marque (ex: "Mattel (6)")
- Dans la liste:
  - Tri par prix croissant/d�croissant
  - Pagination (4 jouets par page)
