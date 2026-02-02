# Налаштування середовища розробки

[← Повернутися до основної документації](../README.md) | [CLAUDE.md](../CLAUDE.md)

Інструкції для встановлення необхідного програмного забезпечення на різних платформах.

## Скрипти автоматичної установки

| Скрипт        | Платформа   | Опис                                                                                  |
| ------------- | ----------- | ------------------------------------------------------------------------------------- |
| `install.ps1` | Windows     | PowerShell скрипт. Використовує Scoop для встановлення PHP, Composer, MySQL, Git     |
| `install.sh`  | macOS/Linux | Bash скрипт. Використовує Homebrew (macOS) або apt/dnf (Linux)                        |

---

## Windows

### Важливо про кодування файлу install.ps1

> **Увага!** Якщо при запуску install.ps1 з'являється помилка ParserError або текст виглядає "кракозябрами", переконайтесь, що файл збережено у кодуванні **UTF-8 без BOM**. У VS Code це можна зробити так:
>
> 1. Відкрийте install.ps1 у редакторі.
> 2. Внизу справа натисніть на кодування (наприклад, "UTF-8" або "Windows1251").
> 3. Виберіть "Зберегти з кодуванням..." → "UTF-8".
> 4. Перезапустіть PowerShell і спробуйте ще раз.

---

### Автоматично (скрипт PowerShell)

1. Відкрийте PowerShell (не обов'язково від імені адміністратора):

2. Дозвольте виконання скриптів:

   ```powershell
   Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
   ```

3. Запустіть скрипт:

   > **Важливо:** Перед запуском переконайтесь, що ви знаходитеся у папці `setup`. Якщо ви бачите помилку "не распознано как имя командлета...", це означає, що PowerShell відкрито не в тій папці. Виконайте:

   ```powershell
   # Для PowerShell використовуйте подвійні зворотні слеші (\\):
   cd шлях\\до\\php-labs\\setup
   .\install.ps1
   ```

### Варіант 1: WSL (рекомендовано)

1. Відкрийте PowerShell як адміністратор і виконайте:

```powershell
wsl --install
```

1. Перезавантажте комп'ютер

2. Відкрийте Ubuntu (WSL) та виконайте:

```bash
# Для Bash використовуйте прямі слеші (/):
cd /path/to/php-labs/setup
chmod +x install.sh
./install.sh
```

### Варіант 2: Scoop

1. Встановіть [Scoop](https://scoop.sh/) (в PowerShell):

```powershell
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser -Force
Invoke-Expression (New-Object System.Net.WebClient).DownloadString('https://get.scoop.sh')
```

1. Встановіть PHP, Composer та MySQL:

```powershell
scoop install php composer mysql git
```

1. Перезапустіть термінал та перевірте:

```powershell
php -v
composer -V
mysql --version
git --version
```

### Варіант 3: XAMPP

1. Завантажте [XAMPP](https://www.apachefriends.org/download.html)
2. Встановіть з компонентами: Apache, MySQL, PHP
3. Додайте PHP до PATH: `C:\xampp\php`
4. Встановіть Composer окремо: [getcomposer.org](https://getcomposer.org/download/)

---

## macOS

### Автоматично (скрипт)

```bash
cd setup
chmod +x install.sh
./install.sh
```

### Вручну (Homebrew)

1. Встановіть Homebrew (якщо ще не встановлено):

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

1. Встановіть PHP, Composer та MySQL:

```bash
brew install php composer mysql
brew services start mysql
```

1. Перевірте:

```bash
php -v
composer -V
mysql --version
```

---

## Linux

### Автоматично (скрипт)

```bash
cd setup
chmod +x install.sh
./install.sh
```

### Ubuntu/Debian

```bash
sudo apt update
sudo apt install -y php php-cli php-mbstring php-xml php-curl php-mysql php-zip
sudo apt install -y composer
sudo apt install -y mariadb-server mariadb-client
sudo systemctl start mariadb
sudo systemctl enable mariadb
```

### Fedora/RHEL

```bash
sudo dnf install -y php php-cli php-mbstring php-xml php-curl php-mysql php-zip
sudo dnf install -y composer
sudo dnf install -y mariadb-server mariadb
sudo systemctl start mariadb
sudo systemctl enable mariadb
```

---

## Перевірка встановлення

Після встановлення виконайте:

```bash
php -v          # PHP 8.x
composer -V     # Composer version 2.x
mysql --version # mysql Ver 8.x або MariaDB
```

## Запуск проєкту

```bash
# Перейти в папку проєкту
cd php-labs

# Запустити PHP файл
php filename.php

# Запустити локальний сервер
php -S localhost:8000
```

Відкрийте в браузері: <http://localhost:8000>

---

## Необхідне ПЗ

- PHP 8.x
- Composer
- MySQL/MariaDB
- Git

---

❓ Якщо виникають проблеми — дивіться [troubleshooting/](../troubleshooting/) для типових рішень.
