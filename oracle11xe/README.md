zrodlo
https://hub.docker.com/r/oracleinanutshell/oracle-xe-11g

docker-compose  up --no-deps --build

zbuduj
docker-compose build

uruchom
docker-compose up

usun
docker-compose -f docker-compose.yml down

wejscie do kontenera
docker exec -it --user=oracle oracle11xe bash
