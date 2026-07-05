#include <stdio.h>
#include <string.h>

const char* sapa(const char nama[], int umur) {
    static char hasil[100];
    if (umur >= 18) {
        snprintf(hasil, sizeof(hasil), "Halo %s, kamu sudah dewasa.", nama);
    } else {
        snprintf(hasil, sizeof(hasil), "Halo %s, kamu masih remaja.", nama);
    }
    return hasil;
}

int main() {
    char nama[50];
    int umur;

    printf("Masukkan nama: ");
    scanf("%49s", nama);
    printf("Masukkan umur: ");
    scanf("%d", &umur);

    const char* pesan = sapa(nama, umur);
    printf("%s\n", pesan);

    return 0;
}
