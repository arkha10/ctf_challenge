#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <stdint.h>
char flag[40]="NCU{just_simple_ret2win_ggwp}";

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
