# Poop
Poop (Php's Object Oriented Project) est une libraire en php qui revisite l'orienté objet.
Son but principal est de favoriser l'utilisation de messages plutôt que des fonctions ou des instructions.

# Mode d'emploi
## Creation de classe

Une classe est créée en envoyant le message make_child à la classe parent. Par défaut
la classe parent est la classe Object.
> $Parent->make_child("Enfant");
> $Object->make_child("Tartiflette");

Un objet classe est alors crée et stocké dans la variable du même nom.

L'ajout d'une méthode de classe se fait alors en envoyant à la nouvelle classe le message define
avec en argument le nom de la méthode et une fonction anonyme contenant son corps.
> $Tartiflette->define("tempsOptimalDeCuisson", function(){return "Le meilleur temps, c'est 30 minutes !";})

De la même manière une méthode d'instance se fera avec le message define_instance.
> $Tartiflette->define_instance("cuire", function(){return "Cuisson lancee !";});

L'appel d'une méthode de classe se fait alors par l'envois du message call, suivit du nom de la
méthode et de ses arguments.
> $Tartiflette->call("tempsOptimalDeCuisson");

Enfin, le message freeze permet de geler une classe, ce qui l'enpêche de générer des instances.
