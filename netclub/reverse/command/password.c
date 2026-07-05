#include <stdio.h>
#include <string.h>

int main() {
    char i[100];
    const char *p = "pass456"; 
    
    printf("Masukkan password: ");
    if (fgets(i, 100, stdin) == NULL) {
        return 1;
    }
    
    size_t l = strlen(i);
    if (l > 0 && i[l - 1] == '\n') {
        i[l - 1] = '\0';
    }
    
    if (strcmp(i, p) == 0) {
        printf("\nFlag: FLAG{C0ngr44tsss_Correct}\n");
    } else {
        printf("\nAkses Ditolak.\n");
    }
    
    return 0;
}