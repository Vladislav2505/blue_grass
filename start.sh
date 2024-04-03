#!/bin/bash

# Запуск контейнера nginx с помощью Docker Compose
docker compose up -d nginx

# Запуск npm run dev
npm run dev
