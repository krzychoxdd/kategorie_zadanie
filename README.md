# Zadanie
Stworzenie dwóch endpoint-ów obsługujących tworzenie i wyświetlanie listy kategorii. Kategorie muszą wspierać wielojęzyczność.

## Instalacja

Plik .env.example został skonfigurowany pod poniższy opis instalacji. Do instalacji potrzebne jest polecenie make i docker.

```
git clone https://github.com/krzychoxdd/kategorie_zadanie.git
cd kategorie_zadanie
mv .env.example .env
composer install

make dbinstall
make dbrun
make dbstart
make dbcreate

make serve # opcjonalne aby odpalic serwer

php artisan migrate
php artisan test
```
