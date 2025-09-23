#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

# Read current index or initialize to 1
if [ -f info.txt ]; then
  index=$(cat info.txt)
  index=$((index + 1))
  
  # Reset if index reaches 5
  if [ "$index" -eq 5 ]; then
    rm -f info.txt
    echo "Reset: Deleted info.txt (index reached 5)" | tee -a log.txt
    exit 0
  fi
else
  index=1
fi

# Update or create info.txt
echo "$index" > info.txt
echo "Updated info.txt with index $index" | tee -a log.txt

> log.txt
> info.txt
echo "Starting Magento installation..."
echo "Starting Magento installation..." | tee -a log.txt

# Set composer authentication first
composer config -g --auth http-basic.repo.magento.com $COMPOSER_USER $COMPOSER_PASSWORD

# Create a temporary directory for Magento installation
mkdir -p /tmp/magento-install
cd /tmp/magento-install

# Install composer dependencies in temporary directory
composer create-project --repository-url=https://repo.magento.com/ \
    magento/project-community-edition=2.4.7 ./

# Move Magento files to the web root, excluding the install script
cd /var/www/html
cp -r /tmp/magento-install/* ./
rm -rf /tmp/magento-install

# Wait for the database and OpenSearch to be ready
until nc -z $DB_HOST 3306; do
  echo "Waiting for MySQL to be ready..."
  echo "Waiting for MySQL to be ready..." | tee -a log.txt
  sleep 5
done

until nc -z $OPENSEARCH_HOST 9200; do
  echo "Waiting for OpenSearch to be ready..."
  echo "Waiting for OpenSearch to be ready..." | tee -a log.txt
  sleep 5
done

# Run the Magento setup command using environment variables
php bin/magento setup:install \
  --base-url="$MAGENTO_BASE_URL" \
  --db-host="$DB_HOST" \
  --db-name="$DB_NAME" \
  --db-user="root" \
  --db-password="$DB_PASSWORD" \
  --search-engine=opensearch \
  --opensearch-host="$OPENSEARCH_HOST" \
  --opensearch-port=9200 \
  --admin-firstname=Admin \
  --admin-lastname=User \
  --admin-email=admin@yourdomain.com \
  --admin-user="$MAGENTO_ADMIN_USER" \
  --admin-password="$MAGENTO_ADMIN_PASSWORD" \
  --language=en_US \
  --currency=KWD \
  --timezone=UTC \
  --use-rewrites=1

#php bin/magento sampledata:deploy

echo "Magento installation complete."
echo "Magento installation complete." | tee -a log.txt

# Create proper Magento module directory structure
mkdir -p /var/www/html/app/code
if [ ! -d "/var/www/html/app/code/Bede" ]; then
	cd /var/www/html/app/code
	git clone https://github.com/didats/Bede_PaymentGateway.git ./
fi

cd /var/www/html

find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 777 var generated pub/static pub/media

php bin/magento deploy:mode:set developer
#php bin/magento module:enable Bede_PaymentGateway

# Deploy static content and compile
php bin/magento setup:upgrade

# Regenerate composer autoloader
composer dump-autoload

# Clear cache before compilation
php bin/magento cache:clean
php bin/magento cache:flush

# Compile DI
php bin/magento setup:di:compile

# Deploy static content
php bin/magento setup:static-content:deploy -f

# Final cache clear
php bin/magento cache:clean
php bin/magento cache:flush

echo "Deployment finished."
echo "Deployment finished." | tee -a log.txt

# Ensure we're in the correct directory and start PHP-FPM
cd /var/www/html
echo "Starting PHP-FPM..."
exec php-fpm
