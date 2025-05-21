#!/bin/bash

# verificar se há mudanças no repositório
if git diff --staged --quiet && git status --porcelain | grep '??' -q; then
    echo "Nenhuma mudança no repositório. parando script.";
    exit 1
fi

# gere a mensagem
echo "Mudanças encontradas.\n Gerando commit com IA.";
openai api chat.completions.create -m gpt-4o -g user "Crie uma mensagem de commit utilizando o padrão Conventional Commit para as seguintes alterações de código: $(git diff) e se houver, adicione na mensagem de commit também sobre os arquivos novos adicionados: $(git status)"

# verifica se a mensagem foi gerada
if [ ! -f commit_msg.txt ]; then
    echo "Mensagem de commit não gerada. parando script.";
    exit 1
fi

# exibe a mensagem de commit
echo "Mensagem gerada com sucesso:";
cat commit_msg.txt

# confirmação do usuário antes de commitar a mensagem
read -p "Deseja commitar a mensagem acima? (s/n): " confirm

if [ "$confirm" != "y" ]; then
    echo "Mensagem de commit não foi confirmada. parando script.";
    exit 1
fi

# faz o commit com a mensagem gerada
git commit -am "$(cat commit_msg.txt)"

# exibe mensagem de sucesso
echo "Commit realizado com sucesso."
