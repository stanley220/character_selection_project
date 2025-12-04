# character_selection_project
# 🧙 Kreator Postaci: Aplikacja Webowa PHP/MySQL

Projekt demonstrujący pełny cykl życia użytkownika w aplikacji webowej (rejestracja, logowanie, zarządzanie sesją) z wykorzystaniem technologii backendowych. Głównym celem jest pokazanie umiejętności w zakresie **bezpiecznego uwierzytelniania** i **integracji z bazą danych MySQL** przy użyciu najlepszych praktyk PHP.

## 🛡️ Kluczowe Elementy i Wartości Dodane

* [cite_start]**Bezpieczne Uwierzytelnianie:** Hasła są haszowane funkcją `password_hash()` [cite: 35, 80, 140][cite_start], a weryfikacja odbywa się za pomocą bezpiecznej metody `password_verify()`[cite: 17, 23, 141].
* [cite_start]**Ochrona przed SQL Injection:** Wszystkie operacje na bazie danych wykorzystują obiekty **PDO (PHP Data Objects)** [cite: 86] [cite_start]i **Prepared Statements** [cite: 55][cite_start], używając nazwanych symboli zastępczych (Named Placeholders, np. `:email`, `:hash`) [cite: 56, 90] [cite_start]w celu oddzielenia kodu SQL od danych[cite: 58].
* [cite_start]**Walidacja Backendowa:** Pełna walidacja po stronie serwera (PHP) dla pól takich jak email [cite: 43, 190][cite_start], długość hasła [cite: 45] [cite_start]i wiek (weryfikacja ukończenia 18 lat)[cite: 282, 329].
* [cite_start]**Dynamiczne Routing:** Logika w `login.php` dynamicznie kieruje użytkownika na właściwą stronę na podstawie stanu konta:
    * Brak Postaci $\rightarrow$ Kreator Postaci (`index.php`)
    * Posiada Postacie $\rightarrow$ Menu Wyboru (`menu.php`)
* [cite_start]**Dobre Praktyki PHP:** Konsekwentne użycie operatora ścisłego porównania `===` [cite: 103] [cite_start]w celu uniknięcia błędów konwersji typów[cite: 115].

## ⚙️ Instrukcja Uruchomienia Projektu

### 1. Wymagania Techniczne

* **Środowisko Serwerowe:** PHP 7.4+
* **Baza Danych:** MySQL / MariaDB
* **Lokalne Środowisko:** XAMPP / WAMP / Laragon (zapewnia Apache, MySQL i PHP)

### 2. Klonowanie Repozytorium

```bash
git clone [https://github.com/stanley220/character_selection_project.git](https://github.com/stanley220/character_selection_project.git)
cd character_selection_project
