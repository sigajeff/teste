# Atonal Boiler Plate

Uma base padrão de desenvolvimento de temas em wordpress


### Adicione como subdiretório do git

É imprecíndível serguir todos os passos.

-Crie um novo repositório git para seu projeto a partir do github.

-Instale o wordpress

-Copie a url de seu novo diretorio, aqui chamada de [url-my-directory]

-Utilize o comando para clonar em 'wp-content/themes/'. Substitua o [new-theme]

    git clone --recurse-submodules https://github.com/gittower/git-crash-course.git [new-theme]

-Entre na pasta de seu tema e use os comandos para que o boiler plate não mais escute suas alterações

    git remote rm origin
    git remote add origin [url-my-directory]

-Agora você está pronto para usar o boiler plate!



