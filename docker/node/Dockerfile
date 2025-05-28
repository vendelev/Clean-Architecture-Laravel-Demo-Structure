# https://github.com/nodejs/docker-node/blob/main/docs/BestPractices.md
FROM node:22.14.0-alpine3.21 AS node22

ENV YARN_VERSION 1.22.19
ENV VUE_CLI_VERSION 5.0.8
ENV HOST 0.0.0.0

ARG UID=1000
ARG GID=1000
ENV UID=${UID}
ENV GID=${GID}

RUN <<EOF
  apk update
  apk --no-cache add shadow
  groupmod --gid=${GID} node
  usermod --uid=${UID} --gid=${GID} node
  apk del shadow
  rm -frv /var/cache/apk/*
EOF

ENV NPM_CONFIG_PREFIX /home/node/.npm-global
ENV PATH $PATH:/home/node/.npm-global/bin

WORKDIR /var/www/frontend

USER node

RUN <<EOF
  yarn policies set-version ${YARN_VERSION}
  yarn global add @vue/cli@${VUE_CLI_VERSION} @vue/cli-service@${VUE_CLI_VERSION}
EOF
