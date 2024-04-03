
# Interface ChatBot - LLM 

Este repositório apresenta um projeto educacional desenvolvido para uma apresentação na disciplina de Inteligência Artificial. O projeto demonstra a integração de um chatbot personalizável, construído com Laravel, Vue.js e utilizando a API do GPT4All, um ecossistema de modelos de linguagem de código aberto.

## Principais Tecnologias Utilizadas
- **Laravel**: Framework PHP para desenvolvimento de APIs REST.
- **Vue.js**: Biblioteca JavaScript para construção de interfaces de usuário dinâmicas.
- **GPT4All API**: API que suporta modelos de linguagem no formato GGUF (.gguf), permitindo a execução de modelos localmente em CPUs de consumo e GPUs.
- **Redis**: Banco de dados em memória utilizado para armazenar o contexto das mensagens e histórico do chatbot.
- **Docker**: Ambiente de contêineres para facilitar a execução e gerenciamento do projeto.

## Modelo Utilizado Para Teste
- **Modelo hermes-2-pro-mistral-7b**
  - Descrição:  Hermes 2 Pro é uma versão atualizada e retrainada do Nous Hermes 2, consistindo em uma versão atualizada e limpa do OpenHermes 2.5 Dataset.

## Funcionalidades do Projeto
- **Chatbot Personalizável**: Utilize a API do GPT4All para integrar modelos de linguagem personalizados em seu chatbot.
- **Interface Vue.js Responsiva**: Design moderno e interativo para uma experiência de chatbot envolvente.
- **Backend Laravel**: Lógica robusta de backend para gerenciar solicitações, respostas e manter o contexto da conversa.
- **Armazenamento no Redis**: Utilize o Redis para armazenar o contexto das mensagens e o histórico de conversas do chatbot.
- **Ambiente Dockerizado**: Execute o projeto em um ambiente Docker para facilitar a implantação e o gerenciamento de contêineres.


## Demonstração

https://github.com/cassiuslc/projeto-ia/assets/51304545/9c684c82-0192-4ddf-b0d6-f410312788c0

## Instalação

Siga os passos abaixo para configurar e executar o projeto:

1. Garanta que você possui um ambiente Docker com WSL perfeitamente funcional.

2. Clone o projeto para uma pasta com o seguinte comando:

```bash
git clone https://github.com/cassiuslc/projeto-ia.git
```
3. Execute um terminal na pasta do projeto e coloque o seguinte comando para construir e iniciar os contêineres:
```bash
cd projeto-ia
docker-compose up -d --build
```
4. Acesse o console do Docker:
```bash
docker-compose exec php bash
```
5. Garanta que o Vite foi instalado corretamente. Caso contrário, instale-o.

6. Execute o comando para baixar dependências do projeto:
```bash
composer setup
```
7. Após a configuração, inicie a aplicação:
```bash
docker-compose up -d
```

## Passos Adicionais (Configuração das APIS do modelo)

Siga estes passos adicionais para configurar o modelo de linguagem e conectar o chatbot ao GPT4All:

1. **GPT4All API**:
   - Siga o passo a passo no repositório do GPT4All em [GPT4All API](https://github.com/nomic-ai/gpt4all/tree/main/gpt4all-api). Caso você esteja usando uma API da OpenAI, pode pular este passo.

2. **Baixe o Modelo de Linguagem**:
   - Baixe o modelo mais recente [NousResearch/Hermes-2-Pro-Mistral-7B](https://huggingface.co/NousResearch/Hermes-2-Pro-Mistral-7B) ou qualquer outro modelo em formato GGUF.
   - Coloque o modelo na pasta `model` e copie o arquivo `.env` para a pasta principal (do GPT4All), indicando o modelo. Este processo é detalhado no passo a passo do repositório do GPT4All.

3. **Aguarde a Inicialização**:
   - O GPT4All pode demorar um pouco para iniciar e responder. Recomendamos que aguarde até que esteja completamente iniciado.

4. **Conexão do Docker**:
   - Com o contêiner Docker do GPT4All online e exibindo a mensagem "Startup complete" no console, conecte o contêiner à mesma rede do contêiner do Laravel:

   ```bash
   docker network connect my_network gpt4all_api

## Documentação da API do backend laravel

#### Verifica o status de saúde do chatbot.

```http
  GET /api/bot/check

```

| Código   | HTTP       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `200`      | `Resposta` | `True` O modelo está online. |
| `200`      | `Resposta` | `False` O modelo está offline. |
| `500`      | `Erro` | Erro interno do servidor. |



#### Obtém o histórico de conversas do chatbot.
```http
  GET /api/bot/historico

```
Exemplo Resposta
```json
[
  {
    "ator": "user",
    "mensagem": "Mensagem do usuário",
    "timestamp": 1648741861
  },
  {
    "ator": "assistant",
    "mensagem": "Resposta do assistente",
    "timestamp": 1648741923
  }
]
```
| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `data` | `json` | Retorno do histórico |

#### Insere uma nova mensagem no chatbot.
```http
POST /api/bot/inserir
```
##### Descrição
Este endpoint permite inserir uma nova mensagem no chatbot. É necessário fornecer a mensagem e o ator (usuário ou assistente).

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `mensagem` | `string` | **Obrigatório**. A mensagem a ser inserida. |
| `ator` | `string` | **Obrigatório**. O ator da mensagem, pode ser user ou assistant. |

##### Exemplo de Requisição

```json
POST /api/bot/inserir
Content-Type: application/json

{
  "mensagem": "Nova mensagem do usuário",
  "ator": "user"
}

```
#### Reseta o histórico
```http
  DELETE /api/bot/reset

```

| Código   | HTTP       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `200`      | `Resposta` | `True` Resetado |
| `500`      | `Erro` | Erro interno do servidor. |

## Melhorias

Este projeto serve como um exemplo educacional para demonstrar a integração de um chatbot com a API GPT4All, oferecendo uma visão prática das tecnologias e conceitos discutidos na disciplina de Inteligência Artificial.

**Nota:** Certifique-se de revisar a documentação da API GPT4All para obter informações detalhadas sobre como formatar e integrar modelos de linguagem.

## 🚀 Sobre mim

- [@cassiuslc](https://www.github.com/cassiuslc)


## Links

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/cassiuslc)

### Referências dos Projetos de Terceiros

1. **Projeto GPT-4 All (API REST de LLM):**
   
   - Repositório: [GitHub - nomic-ai/gpt4all](https://github.com/nomic-ai/gpt4all)

2. **Modelo usado como exemplo GPT-4 All (Nous-Hermes-2-Mistral-7B-DPO):**
   
   - Hugging Face Model: [Nous-Hermes-2-Mistral-7B-DPO.Q4_0.gguf](https://huggingface.co/NousResearch/Nous-Hermes-2-Mistral-7B-DPO-GGUF/blob/main/Nous-Hermes-2-Mistral-7B-DPO.Q4_0.gguf)

3. **Font Awesome (Ícones):**
   
   - Site: [Font Awesome](https://fontawesome.com/)



## Licença

[MIT](https://choosealicense.com/licenses/mit/)

