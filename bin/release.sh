if ./craft install/check
then
    ./craft migrate/all
    ./craft project-config/apply
    ./craft cache/flush-schema db
fi
