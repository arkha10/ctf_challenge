#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <stdint.h>
char flag[40]="NCU{similar_to_stack_canary}";

void win() {
    printf("Flag: %s\n", flag);
    fflush(stdout);
    exit(0);
}

void vuln() {
    char myvar[32];
    uint64_t proteksi = 0x9876543212345678ULL;
    puts("any question:");
    scanf("%s", myvar);
    if (proteksi != 0x9876543212345678ULL) {
        printf("damn ada hacker wok !");
        exit(0);
    }
    printf("pertanyaanmu: %s\n", myvar);
}

void setup() {
    setbuf(stdin, NULL);
    setbuf(stdout, NULL);
    setbuf(stderr, NULL);
}

int main(void) {
    setup();
    vuln();
    puts("Program selesai.");
    return 0;
}
