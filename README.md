# Dungeons & Dragons App

Projekt webowy oparty na Symfony (backend), Vue 3 (frontend) i PostgreSQL (baza danych). Aplikacja będzie umożliwić tworzenie prostych opowieści pod wybór ścieżki, a w późniejszych wersjach tworzenie bardziej zaawansowaych gier (postaci, kampanii, sesji, notatek oraz interakcji między graczami i Mistrzem Gry).

## Technologie

- **Backend:** Symfony 6 (API Platform)
- **Frontend:** Vue 3 
- **Baza danych:** PostgreSQL
- **DevOps:** Docker (opcjonalnie), Composer, NPM

## Instalacja

### Backend (Symfony)

```bash
cd backend
composer install
cp .env .env.dev
# uzupełnij dane dostępu do PostgreSQL
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load 
php -S localhost:8000 -t public
