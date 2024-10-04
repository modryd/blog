# Blog
Sample Blog application


# Installation
## Step 1: Install Symfony CLI
curl -sS https://get.symfony.com/cli/installer | bash

## Step 2: Create a new Symfony project
symfony new blog --webapp

# Application
php bin/console make:controller DefaultController

# Seed data
composer require --dev doctrine/doctrine-fixtures-bundle
php bin/console doctrine:fixtures:load

php bin/console doctrine:schema:update --force

# Application available at http://localhost:8023
