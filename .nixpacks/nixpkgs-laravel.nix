{ pkgs }:

{
  # Paquetes básicos necesarios para Laravel
  deps = with pkgs; [
    php82
    php82-intl
    php82-pdo
    php82-mysql
    php82-curl
    php82-gd
    php82-mbstring
    php82-xml
    php82-zip
    php82-bcmath
    php82-tokenizer
    php82-ctype
    php82-session
    php82-fileinfo
    php82-redis
    nginx
    nodejs
    yarn
    composer
    git
  ];

  # Variables de entorno adicionales
  env = {
    PHPRC = "/tmp/php";
    NODE_ENV = "production";
  };
}