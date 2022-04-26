# Team Murakami         
          
## Developpeurs :      
         
• [Doriane Farau](https://github.com/DFarau)         
• [Naiara Trivino](https://github.com/nt-95)       
• [Paola Cyprien](https://github.com/Pao-La-CCC)       
• [Tania Mahouche](https://github.com/TaniaMAHOUCHE)        
• [Valentin Mariot](https://github.com/valentinmariot)         
        
## Installation :     
`npm i`    
      
## Lancement :             
`npm start`     
      
## Workflow :       
              
1. Les PO créent les tickets       
2. Le ticket est attribué à un dev’       
3. Le dev’ crée sa *branch*       
4. Le dev’ commence son travail et effectue des commits réguliers       
5. Le dev’ peut demander des reviews ponctuelles sur le channel #help       
6. Une fois le ticket terminé, envoyer sa MR sur le channel #review. Relecture par un pair minimum + PO obligé        
7. Une fois la MR validée, merge par le dev’ propriétaire de la branche.       
             
### Création d'une *branch* :     
• `git checkout develop` -> On crée toujours les branch depuis develop. Le code est déployé sur prod par les PO.          
• `git fetch -a`     
• `git checkout -b raito-numéroduticket origin/develop`             
• `git push`  -> Votre terminal va vous donner la commande à copier/coller qui ressemblera à la seconde option        
    OU          
• `git push --set-upstream origin [nom de la branch]`        
             
### Commit :      
• `git commit -m '[Nom du composant/de la feuille éditée] - description`     
     
### Push :           
• `git push`          
           
### Rebase :      
• `git fetch -a`     
• `git rebase develop`     
• Effectuer le rebase sur votre IDE. Bien penser à sauvegarder les modifications effectuées.      
• `git rebase --continue`     
• `git push`     
     