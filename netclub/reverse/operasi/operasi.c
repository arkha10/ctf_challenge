#include <stdio.h>
#include <string.h>

int main() {
    int enc[10] = {147, 160, 157, 166, 157, 166, 127, 166, 142, 171};
    char input[100];
    printf("Input: ");
    fgets(input, sizeof(input), stdin);
    int len = strcspn(input, "\n");
    if (len != 10) {
        printf("Wrong length\n");
        return 0;
    }
    for (int i = 0; i < 10; i++) {
        int c = input[i];
        c = c ^ 5;
        c = (c << 1) | (c >> 7);
        c = c ^ (i + 3);
        if (c != enc[i]) {
            printf("Incorrect\n");
            return 0;
        }
    }
    printf("Correct!\n");
    return 0;
}

