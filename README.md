# 🧙 Kreator Postaci: Aplikacja Webowa PHP/MySQL

Projekt demonstrujący pełny cykl życia użytkownika w aplikacji webowej (rejestracja, logowanie, zarządzanie sesją) z wykorzystaniem technologii backendowych. Głównym celem jest pokazanie umiejętności w zakresie **bezpiecznego uwierzytelniania** i **integracji z bazą danych MySQL** przy użyciu najlepszych praktyk PHP.

## 🛡️ Kluczowe Elementy i Wartości Dodane

* **Bezpieczne Uwierzytelnianie:** Hasła są haszowane funkcją `password_hash()`, a weryfikacja odbywa się za pomocą bezpiecznej metody `password_verify()`.
* **Ochrona przed SQL Injection:** Wszystkie operacje na bazie danych wykorzystują obiekty **PDO (PHP Data Objects)** i **Prepared Statements**, używając nazwanych symboli zastępczych (Named Placeholders, np. `:email`, `:hash`) w celu oddzielenia kodu SQL od danych.
* **Walidacja Backendowa:** Pełna walidacja po stronie serwera (PHP) dla pól takich jak email, długość hasła i wiek (weryfikacja ukończenia 18 lat).
* **Dynamiczne Routing:** Logika w `login.php` dynamicznie kieruje użytkownika na właściwą stronę na podstawie stanu konta:
    * Brak Postaci $\rightarrow$ Kreator Postaci (`index.php`)
    * Posiada Postacie $\rightarrow$ Menu Wyboru (`menu.php`)
    
---

## ⚙️ Instrukcja Uruchomienia Projektu

### 1. Wymagania Techniczne

* **Środowisko Serwerowe:** PHP 7.4+
* **Baza Danych:** MySQL / MariaDB
* **Lokalne Środowisko:** XAMPP / WAMP / Laragon

### 2. Klonowanie Repozytorium

```bash
git clone [https://github.com/stanley220/character_selection_project.git](https://github.com/stanley220/character_selection_project.git)
cd character_selection_project 
```

### 3. Konfiguracja Bazy Danych (SQL)

* Uruchom serwer MySQL i stwórz nową bazę danych np. "character_creator". Następnie wykonaj poniższe zapytania SQL, aby stworzyć niezbędne tabele zgodne z kodem PHP:

```sql
-- TABELA 1: USERS (Uwierzytelnianie i profil)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    pass_hash VARCHAR(255) NOT NULL, -- Kolumna hasła, użyta w kodzie PHP
    role VARCHAR(50) NOT NULL DEFAULT 'user',
    birthday DATE, -- Kolumna dodana do walidacji wieku
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABELA 2: CHARACTERS (Przechowywanie Postaci)
CREATE TABLE characters (
    char_id INT AUTO_INCREMENT PRIMARY KEY,
    uId INT NOT NULL,
    nickname VARCHAR(50) NOT NULL,
    class VARCHAR(50),
    race VARCHAR(50),
    gender VARCHAR(10),
    height INT,
    experience INT DEFAULT 0,
    gold_amount INT DEFAULT 0,
    FOREIGN KEY (uId) REFERENCES users(id) ON DELETE CASCADE
);

```

### 4. Konfiguracja Połączenia (PHP)

* Otwórz plik config/db_config.php i zaktualizuj dane dostępowe do swojej bazy danych:

```php
// config/db_config.php
$dsn = 'mysql:host=localhost;dbname=twoja_nazwa_bazy;charset=utf8mb4'; // Zmień: twoja_nazwa_bazy
$db_user = 'twój_użytkownik_mysql'; // Zmień: np. root
$db_pass = 'twoje_hasło_mysql'; // Zmień: np. puste lub ustawione hasło
// ...
```

### 5. Uruchomienie i Testowanie
* Uruchom serwer Apache (np. z panelu kontrolnego XAMPP).

* Przejdź w przeglądarce do adresu projektu: http://localhost/ścieżka_do_projektu/register.php

    Testuj Ścieżki Aplikacji:

        Rejestracja: Wypełnij formularz. Po sukcesie system przekieruje Cię na login.php.

        Logowanie (Nowy Użytkownik): Zaloguj się. System sprawdzi, że nie masz postaci (hasCharacters() zwróci false) i przekieruje Cię do Kreatora (index.php).

        Logowanie (Powracający Użytkownik): Po stworzeniu pierwszej postaci, system przekieruje Cię do Menu Wyboru Postaci (menu.php).