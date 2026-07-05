#include <stdio.h>

void main() {
    char var[8];
    long int rahasia = 0x67676767;
    
    puts("Tebak angka: ");
    scanf("%s", var);
    if (rahasia == 0x41424344) {
        printf("yey kamu menang!!!");
    }
    printf("isi variabel rahasia: 0x%x\n", rahasia);
    puts("bye");
}
