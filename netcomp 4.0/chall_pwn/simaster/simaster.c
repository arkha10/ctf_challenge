#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <time.h>

typedef struct {
    char nim[16];
    int semester;
    int status;
    unsigned long last_sync;
} akun_t;

typedef struct {
    unsigned long token;
    int locked;
} session_t;

static akun_t akun;
static session_t session;
static long *chunk = NULL;

long input(void) {
    char buf[64];
    fgets(buf, sizeof(buf), stdin);
    return atol(buf);
}

void banner() {
    puts("=========================================");
    puts("     SIMASTER UGM | Sistem Akademik       ");
    puts("=========================================");
}

void login() {
    char tmp[64];
    printf("Masukkan NIM: ");
    fgets(tmp, sizeof(tmp), stdin);
    strncpy(akun.nim, tmp, 15);
    akun.semester = 7;
    akun.status = 1;
    akun.last_sync = time(NULL);
    session.token = rand();
    session.locked = 0;
}

int valid_session() {
    if (!akun.status) return 0;
    if (session.locked) return 0;
    return 1;
}

int prompt(void) {
    puts("");
    puts("=== MENU AKADEMIK ===");
    puts("[1] Pengajuan KRS Semester Aktif");
    puts("[2] Pembatalan Mata Kuliah");
    puts("[3] Input Nilai Akademik");
    puts("[4] Cetak KHS Mahasiswa");
    puts("[5] Sinkronisasi Server Akademik");
    puts("[6] Logout Sistem");
    printf("> ");
    return input();
}

void Pengajuan_KRS() {
    if (!valid_session()) return;
    printf("Jumlah SKS diambil: ");
    long sks = input();
    chunk = malloc(sks);
    akun.last_sync = time(NULL);
    puts("KRS berhasil diajukan");
}

void Pembatalan_KRS() {
    if (!valid_session()) return;
    free(chunk);
    puts("KRS berhasil dibatalkan");
}

void Input_Nilai() {
    if (!valid_session()) return;
    printf("Input nilai akhir: ");
    long nilai = input();
    *chunk = nilai;
}

void Cetak_KHS() {
    if (!valid_session()) return;
    printf("Nilai akhir tercatat: %ld\n", *chunk);
}

void Sinkron() {
    malloc(0x500 - 8);
    akun.last_sync = time(NULL);
}

int main(void) {
    setbuf(stdin, NULL);
    setbuf(stdout, NULL);

    srand(time(NULL));
    banner();
    login();

    if (!akun.status) {
        puts("Akses ditolak");
        _exit(1);
    }

    while (1) {
        int pilihan = prompt();
        switch (pilihan) {
            case 1:
                Pengajuan_KRS();
                break;
            case 2:
                Pembatalan_KRS();
                break;
            case 3:
                Input_Nilai();
                break;
            case 4:
                Cetak_KHS();
                break;
            case 5:
                Sinkron();
                break;
            default:
                goto done;
        }
    }

done:
    puts("Logout berhasil");
    return 0;
}
