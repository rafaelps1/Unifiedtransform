FROM redis:alpine

ARG REDIS_PASSWORD=vlk!@2021

RUN mkdir -p /usr/local/etc/redis
COPY ./docker/redis/redis.conf /usr/local/etc/redis/redis.conf
RUN sed -i "s/__REDIS_PASSWORD__/${REDIS_PASSWORD}/g" /usr/local/etc/redis/redis.conf

EXPOSE 6379

CMD ["redis-server", "/usr/local/etc/redis/redis.conf"]
