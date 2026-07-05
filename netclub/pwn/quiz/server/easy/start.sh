#!/bin/bash
# start.sh — ensure spawned process gets a pseudo-tty (pty,raw)
exec socat TCP-LISTEN:1337,reuseaddr,fork \
    EXEC:"/home/pwnuser/run_wrapper.sh",pty,raw,echo=0
