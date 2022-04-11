# Atonal Boiler Plate

Uma base padrão de desenvolvimento de temas em wordpress


### Adicione como subdiretório do git

É imprecíndível serguir todos os passos.

-Crie um novo repositório git para seu projeto a partir do github.

-Instale o wordpress

-Copie a url de seu novo diretorio, aqui chamada de [url-my-directory]

-Utilize o comando para clonar em 'wp-content/themes/'. Substitua o [new-theme]

    git clone --recurse-submodules https://github.com/sigajeff/atonal_bp.git [new-theme]
    
-Entre na pasta de seu tema

-(opcional) Altere o branch de cada submodulo para main, as alterações nos submodulos serão escutadas para o git em todos os projetos. Importante: cria novas versões dos itens para não influenciar em projetos já em produção.

    git submodule foreach "git checkout main"

-Use os comandos para que o boiler plate não mais escute suas alterações

    git remote rm origin
    git remote add origin [url-my-directory]

-Agora você está pronto para usar o boiler plate!



