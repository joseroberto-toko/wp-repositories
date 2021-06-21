# wp-repositories
Listando repositórios do Github

## Instalação Plugin

- Clona o repositorio
- Abra o projeto com seu editor exemplo: Vs-Code.
- Abra o arquivo `frontend.js` localizado no diretório `./wp-repositories/assets/js` e edite constant token
```
const token = 'YOUR_TOKEN'.
```
- Abra o arquivo `index.php` localizado no diretório `./wp-repositories` e edite constant token
```
WP_REPOSITORIES_TOKEN = 'YOUR_TOKEN'.
```
- Altera Configurações de links permanentes para Nome do post
- Ative o plugin WP Repositories


## Instalação WordPress Docker

- Caso queira instalar o Wordpress via Docker copie e o arquivo `./docker-compose.yaml` dentro do repositorio via `RAW` para seu workspace 
- Execute o comando 
```
$ docker-compose up -d 
```
- Siga com a configuração do Wordpress
- Depois clona o plugin WP Repositories in  `./wp-content/plugins`
```
$ git clone https://github.com/joseroberto-toko/wp-repositories.git
```

