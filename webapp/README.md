# TheComm

TheComm é uma implementação de um desafio técnico de uma empresa. Nesse desafio eu tentei demonstrar conhecimentos em mais de uma área: gestão de produtos e desenvolvimento de software.

## Como estou tentando resolver esse desafio?

Como sênior, tenho a vivência de enxergar oportunidades e criar soluções para isso que sejam rápidas de implementar, porém sejam o mais bonitas possíveis no primeiro momento (desde que isso não seja uma POC).

Como o desafio envolve desenvolvimento de uma solução para importação de dados de vendas de um sistema para outro, há a necessidade de pensar em uma interface que faça sentido para o usuário. Isso foi prototipado no figma e está no link a seguir

Visão de todas as telas: https://www.figma.com/file/9xtV4wLGijGYhjNpF5ax8Z/EuReciclo?node-id=4%3A3258
Protótipo: https://www.figma.com/proto/9xtV4wLGijGYhjNpF5ax8Z/EuReciclo?node-id=4%3A3278&scaling=scale-down&page-id=0%3A1&starting-point-node-id=4%3A3278

## Como estou implementando o software

Para este desafio está sendo utilizado o framework Laravel na versão 9. A parte de View está sendo implementada com Twitter Bootstrap na versão 5.

### Por debaixo dos panos a solução é...

- Uma interface de login para que somente usuários autenticados possam enviar arquivos CSV em um determinado formato
- Uma interface que lista as importações já feitas e as pendências dos arquivos enviados
- Uma interface onde o usuário possa escolher o arquivo para fazer o upload
- Um evento de "upload de arquivo" que coloca numa fila uma rotina de importação
	- Esse passo tem o intuito de deixar a interface retornar a mensagem de sucesso do upload e avisar que a importação é assíncrona
- Uma fila que roda as rotinas importação e gera um evento de "importação finalizada com (sucesso|fracasso)"
- Uma rotina escuta o evento de importação e envia um e-mail com a mensagem de resultado

## Os testes

Os testes são realizados de duas formas:

- Teste unitário para validar o processo de validação do arquivo e o envio dele para a base de dados
- Testes de interface que validem o fluxo de uso do usuário baseado na perspectiva do DDD

## Deploy

Foram criadas duas formas: testes/homologação e produção

### Subindo a stack

- Testes / homologação

```
docker-compose -f docker-compose--dev.yml up -d
```

- Produção

```
docker-compose up -d
```

### Rodando migrations e testes

- Rodando migrations

```
docker exec thecomm_web_1 composer renew && composer setprod
```

- Rodando os testes (disponível somente em ambiente de testes/homologação)

```
docker exec thecomm_web_1 php artisan test
```

### Proxy reverso

Utilizado em ambiente de desenvolvimento o Nginx Proxy Manager. Para a configuração é necessário informar:

- domain name: thecomm.test
- scheme: http
- Forward Hostname / IP: thecomm_web_1
- Forward Port: 8080

#### Network

Criar a rede proxymng

```
docker network create proxymng
```

E adicionar essa rede às redes conhecidas pelo serviço 'web' existente no docker-compose.yml