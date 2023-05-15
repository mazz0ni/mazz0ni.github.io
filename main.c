#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <string.h>

int main(){
    system("clear");
    printf("ALUNNO's DAY v0.2 by mazz0ni.exe\n\n");
    int day, i, j, nday, currday, k;
    char nome[30], c, choose;
    FILE *file;
    time_t t=time(NULL);
    
    file=fopen("alunni.txt", "r+");
    
    struct tm date = *localtime(&t);
    day=date.tm_mday;
    day=(day%19)-1;

    currday=(date.tm_mon+1);
    currday*=100;
    currday+=date.tm_mday;

    j=0;

    do{
        fseek(file, (20*(day+j)), SEEK_SET);
        c=' ';
        i=0;
        while(c!='-'){
            c=fgetc(file);
            nome[i]=c;
            i++;
        }

        nday=0;
        for(k=0; k<5; k++){
            c=fgetc(file);
            if(c!='.'){
                c-=48;
                nday*=10;
                nday+=c;
            }
        }

        nome[i-1]='\0';
        if(nday<=(currday-14)){
            printf("TODAY IS ");
            for(i=0; nome[i]!='\0'; i++){
                printf("%c", nome[i]);
            }
            printf(" DAY");
            printf("\n\n\nL'alunno e' presente? Y/N/X(esci)--->");
            fflush(stdin);
            scanf("%c", &choose);
            if(choose=='y' || choose=='Y'){
                printf("\n\nL'alunno scelto è accettato dal docente? Y/N--->");
                fflush(stdin);
                scanf("%c", &choose);
            }
        }
        j++;
        if(j+day==19){
            j=0;
            day=0;
        }
        if(choose=='n' || choose=='N'){
            system("clear");
        }
    }while(nday>(currday-14) || choose=='n' || choose=='N');

    if(choose=='Y' || choose=='y'){

        printf("\n\nBUONA FORTUNA ");
        for(i=0; i<strlen(nome)-2; i++){
            printf("%c", nome[i]);
        }
        printf("\n\n");

        fseek(file, (20*(day+j-1))+strlen(nome)+1, SEEK_SET);
        
        fprintf(file, "%02d.%02d", (date.tm_mon+1), date.tm_mday);

    }else if(choose=='x' || choose=='X'){
        printf("\n\nARRIVEDERCI\n\n");
    }

    fclose(file);
    system("exit");
    return 0;
}
