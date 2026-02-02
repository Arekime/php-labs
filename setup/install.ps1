# PHP Labs - Windows Setup Script
# Can be run in regular PowerShell (no admin required)

Write-Host "===================================" -ForegroundColor Cyan
Write-Host "  PHP Labs - Environment Setup" -ForegroundColor Cyan
Write-Host "===================================" -ForegroundColor Cyan
Write-Host ""

# Функція перевірки команди
function Test-Command {
    param($Command)
    return [bool](Get-Command -Name $Command -ErrorAction SilentlyContinue)
}

# Install Scoop
function Install-Scoop {
    Write-Host ">>> Checking Scoop..." -ForegroundColor Yellow

    if (Test-Command "scoop") {
        Write-Host "Scoop already installed: $(scoop --version)" -ForegroundColor Green
    }
    else {
        Write-Host "Installing Scoop..." -ForegroundColor Yellow
        Set-ExecutionPolicy RemoteSigned -Scope CurrentUser -Force
        Invoke-Expression (New-Object System.Net.WebClient).DownloadString('https://get.scoop.sh')

        # Update PATH
        $env:Path = [System.Environment]::GetEnvironmentVariable("Path", "Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path", "User")

        Write-Host "Scoop installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Install PHP
function Install-PHP {
    Write-Host ">>> Installing PHP..." -ForegroundColor Yellow

    if (Test-Command "php") {
        Write-Host "PHP already installed: $(php -v | Select-Object -First 1)" -ForegroundColor Green
    }
    else {
        scoop install php
        Write-Host "PHP installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Install Composer
function Install-Composer {
    Write-Host ">>> Installing Composer..." -ForegroundColor Yellow

    if (Test-Command "composer") {
        Write-Host "Composer already installed: $(composer --version)" -ForegroundColor Green
    }
    else {
        scoop install composer
        Write-Host "Composer installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Install MySQL
function Install-MySQL {
    Write-Host ">>> Installing MySQL..." -ForegroundColor Yellow

    if (Test-Command "mysql") {
        Write-Host "MySQL already installed: $(mysql --version)" -ForegroundColor Green
    }
    else {
        scoop install mysql
        Write-Host "MySQL installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Install Git (optional)
function Install-Git {
    Write-Host ">>> Checking Git..." -ForegroundColor Yellow

    if (Test-Command "git") {
        Write-Host "Git already installed: $(git --version)" -ForegroundColor Green
    }
    else {
        Write-Host "Installing Git..." -ForegroundColor Yellow
        scoop install git
        Write-Host "Git installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Main function
Write-Host "Starting installation..." -ForegroundColor Cyan
Write-Host ""

Install-Scoop
Install-PHP
Install-Composer
Install-MySQL
Install-Git

Write-Host "===================================" -ForegroundColor Cyan
Write-Host "  Installation completed!" -ForegroundColor Green
Write-Host "===================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "Version check:" -ForegroundColor Yellow
try { Write-Host "  PHP:      $(php -v | Select-Object -First 1)" -ForegroundColor White } catch { Write-Host "  PHP:      not installed" -ForegroundColor Red }
try { Write-Host "  Composer: $(composer --version 2>&1)" -ForegroundColor White } catch { Write-Host "  Composer: not installed" -ForegroundColor Red }
try { Write-Host "  MySQL:    $(mysql --version 2>&1)" -ForegroundColor White } catch { Write-Host "  MySQL:    not installed" -ForegroundColor Red }
try { Write-Host "  Git:      $(git --version)" -ForegroundColor White } catch { Write-Host "  Git:      not installed" -ForegroundColor Red }

Write-Host ""
Write-Host "Now you can run PHP files:" -ForegroundColor Yellow
Write-Host "  php filename.php" -ForegroundColor White
Write-Host ""
Write-Host "Or start a local server:" -ForegroundColor Yellow
Write-Host "  php -S localhost:8000" -ForegroundColor White
Write-Host ""
Write-Host "IMPORTANT: Restart the terminal to update PATH!" -ForegroundColor Magenta
Write-Host ""