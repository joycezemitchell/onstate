Couchbase, MySQL, NginX and PHP with Docker Compose
==

Requirements
--

 * Latest version of Docker Engine supporting docker compose
 * Command Line Access on your systemn
 * stop any native services which may conflict on the ports needed (referenced in the docker-compose.yml file)

Initial Setup
--

1 -  Clone this repo and checkout a copy. From a command line change (cd) into the repo's root directory

2 - Set/Change couchbase and mysql usernames and passwords by editing the files in ./docker/secrets

3 - Run
    
    docker-compose build

This will build the necessary images, based on the Dockerfiles within each service context.

4 - After the build has finished, run

    docker-compose up -d

This will create a container for each image and link their networks appropriately

The couchbase container will now need further setup:

5 - Run

    docker-compose exec couchbase bash

This command executes bash on the couchbase container and gives you a new command promt on this container

6 - Run this at the container promopt

    ./install.sh

This script initialies the couchbase server with the following

 * an admin user (and password)
 * an application user (with password)
 * 3 buckets, with primary keys
 * gives the application user full access to each bucket
 
7 - Don't forget to

    exit
    
afterwards to get back to your native/host terminal! 

MySQL
--

MySQL has been added very quickly by referencing the percona offical Dockerfile.

There are 4 secret files which the docker-compose.yml file also maps to environment variables for setting up and running MySQL.

 * mysql_root_password - The corresponding environment variable is REQUIRED
 * mysql_database - A database with this name will be created
 * mysql_user - non root user
 * mysql_pass - password for non root user

To get a mysql command promt run

    docker-compose exec mysql bash

(more on that command format below, in Continued Use)
To get a cli on the mysql container, then run

    mysql -u root -p

(enter the contents of ./docker/secrets/mysql_root_pass when prompted)

Secrets
--

Usernames and passwords can be defined in ./docer/secrets/

The files in ./docker/secrets/ are then mounted to /run/secrets/ in the containers that requite them (as specified in docker-compose.yml)

Continued Use
--

The containers can by turned off with

    docker-compose down

And back on again with

    docker-compose up -d
    
(The -d flag detatches the process from the command prompt, allowing continued use of youe native CLI)

You can run an executable on any of the containers with

    docker-compose exec {container-name} {executable-name}

For example
    
    docker-compose exec php bash

Will give you a CLI on the php container.

Changing configuration
--

Don't try to change the configuration on the containers themselves, changes won't be persisted or tracked and the containerns may not have the necessary tools to restart the services.

Instead, make changes in the Dockerfiles or docker-compose.yml files and rebuild the images/containers

PHP Configuration
--

The Dockerfile at php/Dockerfile shows how this container has been configured. Configuration changes and/or changes to the Dockerfile or docker-compose.yml will require a rebuild

Nginx Configuration
--

Configuration has been set with nginx/etc/server.conf

Should you wish to alter this configuration you will need to rebuild the nginx container

MySQL Configuration
--

The percona docker hub page gives details on how to configure percona beyond the defaults. You would create a directory at ./mysql/etc and add any necessary .cnf files here. You would then edit the ./mysql/Dockerfile to copy ./mysql/etc to the relevant location within the image.

Hostnames in Docker
--

Use the service name from docker-compose.yml to connect one container to another, eg to connect to the couchbase container from the php container use 'couchbase' or fron nginx to php, use 'php'. Services names in the repo are

 * couchbase
 * nginx
 * php
 * mysql

PHP Source Files
--

For a PHP application, the source files should live in src, the nginx webserver is configured to use src/project/html as the web root. As such you can develop an applictaion within project, and add other libraries/dependencies/frameworks under src at the same level as src/project

To test, create the file, src/project/html/info.php with the following code

    <?php
    phpinfo();

Then go to

    http://localhost/info.php

You should see a standard php info page

/Ends
