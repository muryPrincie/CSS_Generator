## IMPORTANT !
### Prérequis

- PHP 8.x (ou PHP 7.x)
- Extension PHP GD activée (obligatoire pour la génération des sprites)

### Vérifier l’extension GD :
php -m | grep gd

Si rien n’est affiché, installez-le :
- Sur Debian/Ubuntu : sudo apt install php-gd
- Sur Mac (brew) : brew install gd && brew reinstall php

# CSS GENERATOR


## Générer une image sprite à partir de plusieurs PNG.

Explorer un dossier récursivement.

🔧 Utilisation
bash
Copier
Modifier
php script.php
👉 Génère une sprite avec les images Ekko dans assets vous pourrez mettre plus tard vos propres images/.
Fichier généré nom par défaut: image.png

# POUR RENOMMER VOTRE IMAGE GÉNERÉE
php script.php -i + nom_du_png

👉 Avec l'argument i, si vous ne le renommez point le sprite s’appellera sprite.png par défaut

bash
Copier
Modifier
php script.php -r
👉 Explore récursivement le dossier assets/ et affiche tous les fichiers et dossiers.

⚙️ Fonctionnement rapide
exploreRecursive($dir)
Affiche tous les fichiers et dossiers d’un répertoire (récursif).

createSpriteFromImages($images, $outputImage)
Génère un sprite horizontal avec transparence à partir d’un tableau d’images PNG.

🤔 Pourquoi ce code ?
J’ai utilisé une liste fixe d’images (ekko0 à ekko5) pour tester vite.

Seuls les fichiers PNG sont pris.

Si une image ne se charge pas, on passe à la suivante (pratique).

Le sprite garde la transparence.

Le nom du sprite est personnalisable via -i.

📁 Exemple de sortie
bash
Copier
Modifier
[Dossier] : assets/icons
[Fichier] : assets/icons/image.png
...
Sprite généré : image.png
✅ À améliorer (si t’as envie)
Lire toutes les .png du dossier dynamiquement

Peut gérer d’autres formats (jpg, webp…) mais png conseillé

Ajouter une version verticale ou en grille

Pour toute confusion dans mon code un help sera mis à disposition.