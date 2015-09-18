#!/bin/bash

ENVIRONMENT="prod"
MYSQL_DB_NAME="sf.dev"
MYSQL_USER="root"
MYSQL_PASSWORD="mammouth"

while [[ $# > 1 ]]
do
    key="$1"
    case $key in
        -e|--e)
        ENVIRONMENT="$2"
        shift # past argument
        ;;
        *)
              # unknown option
        ;;
    esac
    shift # past argument or value
done

echo -e "Installing with \e[32m$ENVIRONMENT\e[39m environment ..."

choice=""
while [ "$choice" != "n" ] && [ "$choice" != "y" ]
do
    printf  "\e[46mDo you want to continue ?\e[49m (y/n) "
    read choice
    choice=$(echo ${choice} | tr '[:upper:]' '[:lower:]')
done
if [ "$choice" == "n" ]; then
    exit 0
fi

if [[ ${ENVIRONMENT} == "dev" ]]
then
    rm -Rf var/media
    rm -Rf web/cache
    rm -Rf app/cache/dev

    #php app/console d:d:d --force
    mysqladmin -u${MYSQL_USER} -p${MYSQL_PASSWORD} drop -f ${MYSQL_DB_NAME}
    #php app/console d:d:c || exit 1
    mysqladmin -u${MYSQL_USER} -p${MYSQL_PASSWORD} create ${MYSQL_DB_NAME}

    php app/console c:c || exit 1
    php app/console d:s:c || exit 1

    php app/console e:i --no-interaction || exit 1
    php app/console e:a:create-super-admin admin@example.org admin John Doe || exit 1

    php app/console d:f:l --append --fixtures=src/Ekyna/Bundle/OrderBundle || exit 1
    php app/console d:f:l --append --fixtures=src/Ekyna/Bundle/DemoBundle || exit 1
    php app/console d:f:l --append --fixtures=src/Ekyna/Bundle/SurveyBundle || exit 1
else
    composer install

    php app/console d:d:c
    php app/console d:m:m  --no-interaction || exit 1

    rm -Rf app/cache/prod
    php app/console c:c -e prod || exit 1

    php app/console e:i -e prod || exit 1
    php app/console a:d -e prod || exit 1
    php app/console e:r:b -e prod || exit 1
fi