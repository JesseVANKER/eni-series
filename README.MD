# Series Symfony

## Création du projet

```shell
composer create-project symfony/skeleton series
```

OU

```shell
symfony new series
```

### Webapp (version full)

Installation de l'ensemble des packages (Doctrine, Twig, Form...)

```shell
composer require webapp
```

### Apache-pack

Si vous utilisez Apache pour rediriger toutes les requêtes vers le controlleur frontal (public/index.php).

```shell
composer require symfony/apache-pack
```

### Doctrine

```dotenv
DATABASE_URL="mysql://root:@127.0.0.1:3306/series?serverVersion=8&charset=utf8mb4"
```


Créer le ficher .env.local

```shell
php .\bin\console doctrine:database:create 
```