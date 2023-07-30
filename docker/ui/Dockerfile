# build stage
FROM node:lts-alpine3.18 as build-stage
ARG WORKDIR=/app

WORKDIR /app

# копируем оба 'package.json' и 'package-lock.json' (если есть)
COPY package*.json ./
RUN npm i

COPY . .
RUN npm run build

FROM nginx:stable-alpine as frontend
COPY --from=build-stage /app/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
