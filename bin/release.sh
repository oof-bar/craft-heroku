if php app/craft install/check
then
    php app/craft migrate/all --interactive=0
    php app/craft project-config/apply --interactive=0
    php app/craft cache/flush-schema db --interactive=0
fi
