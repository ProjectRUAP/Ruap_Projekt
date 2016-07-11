/* minimalni program kako bi vidjeli testcaseove. Kliknite na Evaluate */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define FUNKC "conv"
#define DEST "dest2v.csv"
#define SIZE 128
#define COUNT 2000

FILE *f,*f2;
// i,v,c,n
char flags[] = {0,0,0,0};
char strIn[SIZE];
char fileIn[SIZE];
char buffer[SIZE];
char klasa[COUNT][18];
int  iklasa = 0;
char klasa_tekst[COUNT][60];
char *tklasa;
char *tklasa_tekst;

char init(char *c){
     int i= 0;
     int size_c = strlen(c);
     for(; FUNKC[i]; i++){
          if(FUNKC[i] != c[i])
               return 0;
          }
     if(c[i] != ' ') return 0;   
     //printf("1:"); 
/* 
     for(; i < size_c ; i++){
          if(c[i] == ' ')
               continue;
          else
          if(c[i] == '-')
               switch(c[++i]){
                    case 'i': flags[0] = 1; //printf("-%c ", c[i]);
                         break;
                    case 'v': flags[1] = 1; //printf("-%c ", c[i]);
                         break;
                    case 'c': flags[2] = 1; //printf("-%c ", c[i]);
                         break;
                    case 'n': flags[3] = 1; //printf("-%c ", c[i]);
                         break;  
                    default: i--; break;    
                    }
          else break;
          }
*/
     //printf("\n");
/*     if(i >= size_c) return 0;
     for(; i < size_c ; i++){
          int s = 0; 
          if(c[i] == ' ')
               continue;
          else
          if(c[i] == '"'){
               for(i++; c[i] != '"' && i < size_c ; i++)
                     strIn[s++] = c[i];  
               i++;
               break; 
               }
          }
     //printf("2:%s\n", strIn);
*/
     if(i >= size_c) return 0;
     for(; i < size_c ; i++){
          int s = 0; 
          if(c[i] == ' ')
               continue;
          else
               for(; i < size_c ; i++)
                     fileIn[s++] = c[i];
               }
     //printf("3:%s\n", fileIn);
     return 1;
     }
     
char process(){
     int i,c=0,s=0;
     char tbuff[SIZE];       
     strcpy(tbuff,buffer);
     if(tbuff[0] == '\n') return 0;
     for(i = 0; tbuff[i]; i++){
           if(tbuff[i] != ','){
             klasa[iklasa][c] = tbuff[i];
           if(c >= 18)
             klasa_tekst[iklasa][s++] = tbuff[i];
             }
           else c++;
           }
     tklasa = &klasa[iklasa][0];
     tklasa_tekst = &klasa_tekst[iklasa][0];
     iklasa++;
     return 1;
     }
     

int main(void){
    srand(time(NULL));
    strcpy(buffer,"conv Testovi2v.csv");
    char t;
    int i,j,c;
    iklasa = 0;
    int bb = 0;
    /*do{
         t = getchar();
         if(t == '\n')
              break;
         buffer[bb++] = t;
         }while(1);
    buffer[bb] = 0; */
    //scanf("%[^\n]",buffer);
    
    if(!init(buffer)){
      printf("greska:%s",buffer);
      return 0;
      }
    f = fopen(fileIn,"r");
    f2 = fopen(DEST,"w+");

    if(f != NULL){
         int count = 0;
         int row = 1;
         char t;
         fpos_t pos;            
         do{
              /*t = getc(f);
              if(t != '\n'){
                   ungetc(t,f);
                   fscanf(f,"%[^\n]\n",buffer);
                   }*/
              int bbb = 0;
              char tt;
              do{
                   tt = getc(f);
                   if(tt == '\n' || tt == EOF)
                    break;
                   buffer[bbb++] = tt;
                   }while(1);
              buffer[bbb] = 0; 
              if(process()){
                   count++;
                   for(i = 0; i < 18 ; i++){
                         //printf("%c,",tklasa[i]);
                         fprintf(f2,"%c,",tklasa[i]);
                         }
                  // printf("%s\n",tklasa_tekst);
                   fprintf(f2,"%s\n",tklasa_tekst);
                   /*if(!flags[2]){
                        //if(count > 1) printf("\n");
                        if(flags[3]) printf("%d:""%s\n",row,buffer);
                        else printf("%s\n",buffer);
                        }*/
                        //getchar();
                   }
              row++;
              }while(!feof(f));
              
              for(i = 0; i < iklasa-1; i++)
                  for(j = 1; j < iklasa; j++)
                    if(strcmp(klasa_tekst[i],klasa_tekst[j]) /*&& (i % 2 == 0 || j % 2 == 0)*/){
                         for(c = 0; c < 18 ; c++){
                             //printf("%d,%d\n",i,j);
                            // printf("%c,",(klasa[i][c]>=klasa[j][c])?klasa[i][c]:klasa[j][c]);
                             fprintf(f2,"%c,",(klasa[i][c]>=klasa[j][c])?klasa[i][c]:klasa[j][c]);
                         }
                         //printf("%s+%s\n",klasa_tekst[i],klasa_tekst[j]);
                         fprintf(f2,"%s+%s\n",klasa_tekst[i],klasa_tekst[j]);  
                         //getchar(); 
                    }
              /*      
              for(i = 0; i < iklasa-1; i++)
                  for(j = 1; j < iklasa; j++)
                    if(strcmp(klasa_tekst[i],klasa_tekst[j])&& i % 6 == 0){
                         char flag = 0;                                      
                         for(c = 0; c < 18 ; c++){
                             //printf("%d,%d\n",i,j);
                            // printf("%c,",(klasa[i][c]>=klasa[j][c])?klasa[i][c]:klasa[j][c]);
                            if(klasa[i][c] == '1' && klasa[j][c] == '1')
                                 flag = 1;
                             fprintf(f2,"%c,",(klasa[i][c]>klasa[j][c])?klasa[i][c]:(klasa[i][c]==klasa[j][c])?'0':klasa[j][c]);
                         }
                         //printf("%s+%s\n",klasa_tekst[i],klasa_tekst[j]);
                         if(flag)fprintf(f2,"xor:%s+%s\n",klasa_tekst[i],klasa_tekst[j]);  
                         else{
                         do{
                              fgetpos (f2,&pos);
                              pos--;
                              fsetpos(f2,&pos);
                              t = getc(f2); 
                              fsetpos(f2,&pos);
                              //printf("%c",t);
                              //getchar();                                        
                              }while(t != '\n');
                              //fputc ( '\n' , f2 );
                              }
                         //getchar(); 
                    }
              */
         //if(flags[2]) printf("%d",count);
         fclose(f);
         fclose(f2);
         }
    getchar();
    //getchar();
    return 0;
}
