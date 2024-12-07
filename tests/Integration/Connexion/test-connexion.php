<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

echo "Chargement du fichier .env\n";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

echo "Variables d'environnement chargées\n";

$databaseUrl = getenv('DATABASE_URL');
$connectionParams = [
    'url' => $databaseUrl,
    'driver' => 'pdo_pgsql',
];

echo "Tentative de connexion à la base de données\n";

try {
    $connection = DriverManager::getConnection($connectionParams);
    echo "Connexion à la base de données réussie !" . PHP_EOL;
} catch (\Exception $e) {
    echo "Erreur de connexion : " . $e->getMessage() . PHP_EOL;
}

echo "Fin du script de test\n";
