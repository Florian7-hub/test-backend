-- Création de l'utilisateur postgres
CREATE USER postgres WITH SUPERUSER PASSWORD 'postgres';

-- Création de la table todos
CREATE TABLE IF NOT EXISTS todos (
    id UUID PRIMARY KEY,
    description TEXT NOT NULL,
    status TEXT NOT NULL
);
