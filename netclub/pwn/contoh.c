#include <stdio.h>

void main() {
    char buf[8];
    int secret = 0x12345678;

    printf("Masukkan teks: ");
    // scanf("%s", buf);
    fgets(buf, sizeof(buf), stdin);
    printf("buf: %s\n", buf);
    printf("secret: 0x%x\n", secret);
}
