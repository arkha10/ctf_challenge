CC = gcc
BIN = simaster
SRC = simaster.c

CFLAGS = \
	-O0 -g \
	-fstack-protector-strong \
	-fPIE

LDFLAGS = \
	-pie \
	-Wl,-z,relro,-z,now \
	-Wl,-rpath,'./' \
	-Wl,--dynamic-linker=./ld-linux-x86-64.so.2

all:
	$(CC) $(SRC) -o $(BIN) $(CFLAGS) $(LDFLAGS)

clean:
	rm -f $(BIN)
