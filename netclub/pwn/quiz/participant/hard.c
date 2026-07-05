#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <stdint.h>

void win() {
    system("/bin/sh");
}

int main(void) {
    setbuf(stdout, NULL);
    char myvar[32];
    puts("any question:");
    scanf("%s", myvar);
    printf("pertanyaanmu: %s\n", myvar);
    return 0;
}
