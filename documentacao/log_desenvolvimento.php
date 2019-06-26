<?php
21/06/2018 - quinta
-Levantamento de tarefas realizadas
-colocação de regra de papéis para acesso no menu 

nome (quais papéis podem acessar)

procesos e procedimentos (sjd)
    processos (sjd)
        PAD
        FATD
        CJ
        CD
        ADL

    procedimentos (sjd)
        IPM
        Sindicância
        Deserção
        APFD
        IT
        ISO
        Exclusão
        Proced. Outros

Apresentações em juízo ()
    Emails Agendados
    Notas COGER
    Lista apresentações
    Buscar Apresentação
    Locais
    inserir via Excel
    Gerar Memorando
    Dados Unidade

Relatórios ()
    Pendências
    Pendências - Geral
    Processos Prioritários
    Sobrestamentos
    Processos
    Postos/Graduações
    Encarregados
    Defensores
    Ofendidos

Correições
    Ordinária
    Extraordinária

Busca
    PM 
    Ofendido
    envolvido
    Documentacão
    Tramitação COGER

Policiais
    Ficha de Tramitação
    Medalhas
    Elogios
    Excluídos
    Punidos
    Reintegrados
    Denunciados
    Presos
    Procedimentos
    Comportamento
    Respondendo
    Restrições
    Suspensos
    Obitos e Lesões
    Mortos e feridos

Ajuda(sem restrições)
    Manual do usuário
    Modificar senha
    Documentação para IT

Logs (supervisao)
    Processos/Procedimentos
        Log - ADL
        Log - APFD
        Log - CD
        Log - CJ
        Log - Deserção
        Log - Exclusão
        Log - FATD
        Log - IPM
        Log - IT
        Log - Movimento
        Log - PAD
        Log - Proc. Outros
        Log - Sindicância
        Log - Recurso
    Apresentações em juizo
        Log - Notas COGER
        Log - Apresentação
        Log - Locais
        Log - Email
    Administração
        Log - Acessos
        Log - Apagado
        Log - Bloqueios
        Log - Papeis
        Log - Permissões
        Log - Feriados
    Policiais
        Log - FDI
        Log - Cadastro OPM COGER
        Log - Comportamento PM
        Log - Denuncia Civil
        Log - Elogio
        Log - Reintegrado
        Log - Falecimento
        Log - Preso
        Log - Restrição
        Log - SAI
        Log - Suspenso
        Log - Tramitação OPM


22/06/2018 - sexta

- Criação incial do template de Dashboard
- criação de componentes de lista para as pendências expandíveis, recolhíveis e ocultáveis

----
25/06/2018 - segunda

Pendência 00: transferências

1 busca no banco de dados password
2 criação de conexão única para banco de dados password 
3 realização de querys (consulta no banco de dados) para otimizar a localização dos resultados
4 busca salva em cache

26/06/2018 - terça

PENDENCIA 01: COMPORTAMENTO
- confome itens 3 e 4 do  dia 25/06/18

PENDENCIA 02: CADASTRO DE PUNICAO NO FATD MARCADO COMO PUNIDO
- confome itens 3 e 4 do  dia 25/06/18

PENDENCIA 2.1: PRAZO DO FATD
- query mal sucedida por busca inicial conter dados ambíguos de dados replicados

27/06/2018 - quarta

PENDENCIA #2.2: FATD SEM DATA DE ABERTURA
- realização de querys (consulta no banco de dados) para otimizar a localização dos resultados
- busca salva em cache

PENDENCIA #3: PERDA DE PRAZO EM IPM
- realização de querys (consulta no banco de dados) para otimizar a localização dos resultados
- busca salva em cache

PENDENCIA #3.1: IPM SEM DATA DE ABERTURA
- realização de querys (consulta no banco de dados) para otimizar a localização dos resultados
- busca salva em cache

28/06/2018 - quinta

PENDENCIA #4: PRAZO DAS SINDICANCIAS
- realização de querys (consulta no banco de dados) para otimizar a localização dos resultados
- busca salva em cache

PENDENCIA #4.1: SINDICANCIA SEM DATA DE ABERTURA
- realização de querys (consulta no banco de dados) para otimizar a localização dos resultados
- busca salva em cache

29/06/2018 - sexta

Atestado médico 
---

02/07/2018 - segunda

PENDENCIA #5: CONSELHOS DE DISCIPLINA SEM DATA DE ABERTURA
- realização de querys (consulta no banco de dados) para otimizar a localização dos resultados
- busca salva em cache

PENDENCIA #5.1: CONSELHOS DE DISCIPLINA - PRAZO
- realização de querys (consulta no banco de dados) para otimizar a localização dos resultados
- busca salva em cache

03/07/2018 - terça

Instrução teórica de tiro 

04/07/2018 - quarta

TOTAL PENDÊNCIAS FATD, IPM, SINDICÂNCIA, CD 
- busca e salva em cache

Correção bug IT 374/2018

05/07/2018 - quinta

- Instrução prática de tiro

06/07 - sexta
- inclusão das variáveis na VIEW do dashboard
- inclusão de badges para notificação de pendências
- início FATD



