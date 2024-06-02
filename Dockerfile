FROM php
COPY ./register.php ./
COPY ./login.php ./
COPY ./homepage.php ./
COPY ./config.php ./
EXPOSE 3000
CMD ["php", "-S", "0.0.0.0:3000"]