def sapa(nama, umur):
    if umur >= 18:
        return f"Halo {nama}, kamu sudah dewasa."
    else:
        return f"Halo {nama}, kamu masih remaja."

nama = input("Masukkan nama: ")         
umur = int(input("Masukkan umur: "))   
pesan = sapa(nama, umur)   
print(pesan)
