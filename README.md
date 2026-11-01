# Cafe Society

## Installatie
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm run build

## Testaccounts (wachtwoord: password)
- admin@cafesociety.nl (admin)
- sanne@cafesociety.nl (mag reviews plaatsen)
- youssef@cafesociety.nl (nog geen 3 dagen ingelogd)

## AI-gebruik
AI (Claude) gebruikt voor HTML/CSS en als uitleg-hulp bij de backend. Chatlogs zijn beschikbaar.
