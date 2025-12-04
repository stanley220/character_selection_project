# 🧙 Kreator Postaci: Aplikacja Webowa PHP/MySQL

Projekt demonstrujący pełny cykl życia użytkownika w aplikacji webowej (rejestracja, logowanie, zarządzanie sesją) z wykorzystaniem technologii backendowych. Głównym celem jest pokazanie umiejętności w zakresie **bezpiecznego uwierzytelniania** i **integracji z bazą danych MySQL** przy użyciu najlepszych praktyk PHP.

## 🛡️ Kluczowe Elementy i Wartości Dodane

* **Bezpieczne Uwierzytelnianie:** Hasła są haszowane funkcją `password_hash()`, a weryfikacja odbywa się za pomocą bezpiecznej metody `password_verify()`.
* **Ochrona przed SQL Injection:** Wszystkie operacje na bazie danych wykorzystują obiekty **PDO (PHP Data Objects)** i **Prepared Statements**, używając nazwanych symboli zastępczych (Named Placeholders, np. `:email`, `:hash`) w celu oddzielenia kodu SQL od danych.
* **Walidacja Backendowa:** Pełna walidacja po stronie serwera (PHP) dla pól takich jak email, długość hasła i wiek (weryfikacja ukończenia 18 lat).
* **Dynamiczne Routing:** Logika w `login.php` dynamicznie kieruje użytkownika na właściwą stronę na podstawie stanu konta:
    * Brak Postaci $\rightarrow$ Kreator Postaci (`index.php`)
    * Posiada Postacie $\rightarrow$ Menu Wyboru (`menu.php`)
* **Dobre Praktyki PHP:** Konsekwentne użycie operatora ścisłego porównania `===` w celu unikania błędów konwersji typów.

---

## ⚙️ Instrukcja Uruchomienia Projektu

### 1. Wymagania Techniczne

* **Środowisko Serwerowe:** PHP 7.4+
* **Baza Danych:** MySQL / MariaDB
* **Lokalne Środowisko:** XAMPP / WAMP / Laragon (zapewnia Apache, MySQL i PHP)

### 2. Klonowanie Repozytorium

```bash
git clone [https://github.com/stanley220/character_selection_project.git](https://github.com/stanley220/character_selection_project.git)
cd character_selection_project
