# strabismus

An anonymised dataset project to store patient details around strabismus. This uses the yii framework.

To get up and running with this codebase:

    git clone git@github.com:splatEric/strabismus.git
    cd strabismus
    git submodule init
    git submodule update

create a database for the site

    cat [db file name] | mysql [connection details]

    cd htdocs/protected/config
    cp main.example.php main.php

edit main.php to add the database connection details

