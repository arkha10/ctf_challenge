FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    build-essential gcc libc6-dev socat ca-certificates \
 && rm -rf /var/lib/apt/lists/*

# buat user non-root
RUN useradd -m -s /usr/sbin/nologin pwnuser
RUN mkdir /home/user
WORKDIR /home/pwnuser

# copy source + scripts
COPY hard .
COPY run_wrapper.sh ./run_wrapper.sh
COPY start.sh ./start.sh
COPY flag.txt ../user

# compile dan atur permission; flags sesuai tujuan challenge
RUN chmod +x run_wrapper.sh start.sh \
 && chown -R pwnuser:pwnuser /home/pwnuser \
 && chmod 750 /home/pwnuser/hard

USER pwnuser

CMD ["./start.sh"]
