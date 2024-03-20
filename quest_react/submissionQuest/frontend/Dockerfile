FROM node:20-alpine

WORKDIR /app

COPY frontend/src/package.json .
COPY frontend/src/package-lock.json .

RUN npm install

COPY . .