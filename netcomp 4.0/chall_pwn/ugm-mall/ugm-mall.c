#define _GNU_SOURCE
#include <unistd.h>
#include <sys/wait.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>


typedef struct keranjang{
	char * catatan;
	char * barang;
	char ** list_barang;
	int jumlah_barang;
	int index;
	struct keranjang * next;
} keranjang;

int tracker __attribute__((section(".data"))) = 0;
char keranjang_kuning[] __attribute__((section(".data"))) = "echo 'barangmu sudah diproses....'";

void checkout(){
	system(keranjang_kuning);
}

void saran(){
	printf("Adakh kritik / saran?! >> ");
	char * feedback = malloc(40);
	fgets(feedback,40,stdin);
}

keranjang * tambah_barang(keranjang * point){
	char in[250];

	keranjang * node = (keranjang*) malloc(sizeof(keranjang));
	point->next = node;
	node->next = NULL;
	node->index = tracker++;
	node->jumlah_barang = 1;

	printf("\ntambahkan barang >> ");
	fgets(in,sizeof(in),stdin);
	in[strlen(in)-1] = '\0';
	node->barang = malloc(strlen(in)+1);
	strcpy(node->barang, in);

	int i = 0;
	while(in[i] != '\0'){
		if(in[i] == ',')
			node->jumlah_barang++;
		i++;
	}

	i = 0;
	char * ptr;
	ptr = strtok(in,",");
	node->list_barang = malloc(sizeof(char*));
	while(ptr != NULL){
		node->list_barang = realloc(node->list_barang,(i+1)*sizeof(char*));
		node->list_barang[i] = malloc((strlen(ptr) + 1));
		strcpy(node->list_barang[i],ptr);
		i++;
		ptr = strtok(NULL, ",");
	}
	printf("keranjang %d tersimpan",node->index);
	printf("\ncatatan untuk keranjang >> ");
	memset(in,0,sizeof(in));
	fgets(in,sizeof(in),stdin);
	in[strlen(in)-1] = '\0';
	node->catatan = malloc(strlen(in)+1);
	strcpy(node->catatan, in);
	return node;
}

void lihat_keranjang(int index, keranjang * awal){
	int * i = &tracker;
	keranjang * node = awal->next;
	if(index > *i-1){
		printf("\nKeranjang invaldi!\n");
		return;
	}
	while(node != NULL){
		if(index == node->index){
			printf("\nkeranjang ke-%d (catatan: %s)\n",node->index,node->catatan);
			char buff[10];
			int option;
			printf("Mau lihat barang ke berapa? >> ");
			fgets(buff,sizeof(buff),stdin);
			option = atoi(buff);
			if(option > node->jumlah_barang-1){
				printf("\ninvaldi!\n");
				return;
			}
			if(strlen(node->list_barang[option]) > 10){
				printf("\nNama barangmu terlalu panjang ngab\n");
				return;
			}
			printf(node->list_barang[option]);
			break;
		}
		node = node->next;
	}
}

void edit_catatan(int index, keranjang * awal){
	if(index > tracker-1){
		printf("\ninvaldi!!\n");
		return;
	}
	keranjang * node = awal->next;
	char in[250];
	while(node != NULL){
		if(index == node->index)
			break;
		node = node->next;
	}
	printf("\nEdit catatan >> ");
	fgets(in,strlen(node->catatan),stdin);
	in[strlen(in)-1] = '\0';
	strcpy(node->catatan,in);
}


void kurangi_barang(int index, keranjang * point){
	keranjang * node = point->next;
	if(index > tracker){
		printf("\nIndexnya lebih diperhatikan lagi yh\n");
		return;
	}
	while(node != NULL){
		if(node->index == index)
			break;
		node = node->next;
	}
	free(node->list_barang[node->jumlah_barang-1]);
	node->jumlah_barang--;
}

int shop(){
	char buff[8];
	int input;

	keranjang * point = (keranjang*) malloc(sizeof(keranjang));
	point->next = NULL;
	keranjang * awal = point;

	while(1){
		memset(buff,0,sizeof(buff));
		puts("\n1) Tambah barang ke keranjang");
		puts("2) Lihat keranjang");
		puts("3) Edit catatan");
		puts("4) Kurangi barang");
		puts("5) Kritik n saran");
		puts("6) Checkout");


		printf("Pilih opsi >> ");
		fgets(buff, sizeof(buff), stdin);
		input = atoi(buff);
		switch(input){
			case 1:
				point = tambah_barang(point);
				break;
			case 2:
				memset(buff,0,sizeof(buff));
				printf("\nKeranjang nomer berapa? >> ");
				fgets(buff,sizeof(buff),stdin);
				lihat_keranjang(atoi(buff),awal);
				break;
			case 3:
				memset(buff,0,sizeof(buff));
				printf("\nKeranjang nomer berapa? >> ");
				fgets(buff,sizeof(buff),stdin);
				edit_catatan(atoi(buff),awal);
				break;
			case 4:
				memset(buff,0,sizeof(buff));
				printf("\nKeranjang nomer berapa? >> ");
				fgets(buff,sizeof(buff),stdin);
				kurangi_barang(atoi(buff),awal);
				break;
			case 5:
				saran();
				break;
			case 6:
				checkout();
				break;
			default:
				printf("\nlbih diperhatikan lagi yh opsinya\n");
		}
	}
}

void main(){
	setbuf(stdin, NULL);
	setbuf(stdout, NULL);
	setbuf(stderr, NULL);
    puts("  _    _  _____ __  __    __  __           _ _ ");
    puts(" | |  | |/ ____|  \\/  |  |  \\/  |         | | |");
    puts(" | |  | | |  __| \\  / |  | \\  / |   __ _  | | |");
    puts(" | |  | | | |_ | |\\/| |  | |\\/| |  / _` | | | |");
    puts(" | |__| | |__| | |  | |  | |  | | | (_| | | | |");
    puts("  \\____/ \\_____|_|  |_|  |_|  |_|  \\__,_| |_|_|");
    puts("");
    puts("            W E L C O M E   T O");
    puts("            U G M   M A L L");
    puts("");
    puts("   Selamat berbelanja! (sambil hacking tipis2)");
    puts("");
    shop();
    puts("sayonara da da da da");
}
