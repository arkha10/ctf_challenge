#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <stdint.h>
char flag[40]="NCU{place_holder_flag}";

void win() {
    printf("Flag: %s\n", flag);
    exit(0);
}

void vuln() {
    char myvar[32];
    puts("any question:");
    scanf("%s", myvar);
    printf("pertanyaanmu: %s\n", myvar);
}

int main(void) {
    setbuf(stdout, NULL);
    vuln();
    puts("Program selesai.");
    return 0;
}
