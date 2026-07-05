#!/bin/bash
# run_wrapper.sh — reasonable ulimits and environment
# increase CPU/VM for debugging; tune down later
ulimit -t 10            # CPU seconds
ulimit -v 2000000       # virtual memory ~2GB (adjust)
ulimit -u 200           # max user processes
ulimit -n 128           # file descriptors
# allow core dumps for debugging (temporary)
ulimit -c unlimited

export HOME="/home/pwnuser"
export PATH="/usr/bin:/bin"
export TERM="${TERM:-xterm}"
# run the binary directly (no env -i)
exec /home/pwnuser/medium
