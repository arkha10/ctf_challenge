#include <stdio.h>
#include <string.h>
#include <stdlib.h>

char flag[40]="NCU{infokan_jumat_berkah}";

void surga() {
    printf("Flag: %s\n", flag);
    exit(0);
}

void neraka() {
    char myvar[32];
    puts("Kata kata terakhir?:");
    scanf("%s", myvar);
    printf("katamu: %s\n", myvar);
}

int main(void) {
    setbuf(stdout, NULL);
    neraka();
    puts("Program selesai.");
    return 0;
}
