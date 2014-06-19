# SteamDatabase/SteamLinux
#
# Executes the SteamLinux tests from Docker:
#     docker build -t SteamDatabase/SteamLinux .
#     docker run SteamDatabase/SteamLinux
FROM ubuntu:trusty

# Install PHPUnit
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get install phpunit -y -q --no-install-recommends

# Add all SteamLinux files
ADD .phpunit.xml phpunit.xml
ADD .test.php .test.php
ADD GAMES.json GAMES.json

# Use PHPUnit to execute the tests
CMD ["phpunit"]
