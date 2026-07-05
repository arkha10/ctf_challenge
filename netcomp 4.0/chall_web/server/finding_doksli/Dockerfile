FROM node:18.3.0-alpine

WORKDIR /app

COPY package*.json ./

RUN npm install --production

COPY app/ ./

EXPOSE 4000

CMD ["node", "server.js"]