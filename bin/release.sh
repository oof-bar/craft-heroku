if /usr/bin/env php /app/craft install/check
then
    /usr/bin/env php /app/craft up --interactive=0
fi
