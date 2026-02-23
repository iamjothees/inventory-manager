FROM iamjothees/laravel-image:php8.3

RUN source $NVM_DIR/nvm.sh \
    && nvm install 22 \
    && nvm alias default 22 \
    && nvm use default

EXPOSE 5173
EXPOSE 4173