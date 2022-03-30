#################
### VARIABLES ###
#################
COMPOSER=/usr/bin/composer
GRUMPHP=vendor/bin/grumphp

###########################
### 1. INSTALL SNIFFERS ###
###########################
$COMPOSER require --dev -n \
  "friendsofphp/php-cs-fixer:^3.6" \
  "phpro/grumphp:^1.7" \
  "sebastian/phpcpd:^6.0" \
  "slevomat/coding-standard:^7.0" \
  "squizlabs/php_codesniffer:^3.6"

$COMPOSER config -n allow-plugins.dealerdirect/phpcodesniffer-composer-installer true
$COMPOSER config -n allow-plugins.phpro/grumphp true

###############################
### 2. INIT PRE COMMIT HOOK ###
###############################
$GRUMPHP git:init
