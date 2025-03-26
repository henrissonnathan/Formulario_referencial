<?php
// Configurações para os selects
return [
    //Previsão pca
    'pca' => [
        'PCA não elaborado' => 'PCA não elaborado',
        'Não' => 'Não',
        'Sim' =>'Sim'
    ], // Natureza de comtratação
    'contrato' => [
        'Outros' =>'Outros',
        'Seviços' => 'Seviços',
        'Serviço e fornecimento' => 'Serviço e fornecimento',
        'Obra ou serviço de engenharia' =>'Obra ou serviço de engenharia'
    ], // Modalidae se adicionar opisoes tem que modificar os criterios porcanta da dispensa licitação
    'modalidade' => [
        'Licitação' => 'Licitação',
        'Dispensa de licitação' => 'Dispensa de licitação',
        'Inexigibilidade e licitação' => 'Inexigibilidade e licitação',
        'Chamamento público' => 'Chamamento público'
    ], // Critério de adjudicação do objeto
    'criterio' => [
        'Por grupo' => 'Por grupo',
        'Por item' => 'Por item'
    ], // TRATA-SE DE LICITAÇÕES DECORRENTE DE CONVÊNIO/CONTRATO DE REPASSE/OUTROS COM GOVERNO ESTADUAL/FEDERAL?							
    'trata' => [
        'Licitações decorrente de convênio' => 'Licitações decorrente de convênio',
        'Contrato de repasse' => 'Contrato de repasse',
        'Outros com governo Estadual' => 'Outros com governo Estadual',
        'Outros com governo federal' => 'Outros com governo federal'
    ], // COMO FORAM DEFINIDAS AS QUANTIDADES				
    'levantamento' => [
        'Levantamento de necessidades baseado em hístorico de consumo' => 'Levantamento de necessidades baseado em hístorico de consumo',
        'Projeto ou pareceres técnicos' => 'Projeto ou pareceres técnicos',
        'Levamtameto de necsssidade' => 'Levamtameto de necsssidade',
        'Outros' => 'Outros'
    ], // PARÂMETRO UTILIZADO PARA OBTENÇÃO DO VALOR DE REFERÊNCIA				
    'parametro' => [
        'menor preço' => 'menor preço',
        'Preço mediano' => 'Preço mediano',
        'Preço medio' => 'Preço medio',
        'Outros' => 'Outros',
    ], // "FONTES DE PESQUISA 
    'fonte' => [
        'PNCP' => 'PNCP',
        'contratações' => 'Contratações similares',
        'tabela' => 'Tabela de referência oficial',
        'cotacao' => 'Cotações direta',
        'outros' => 'outros'
    ], //FOI OBTIDO ORÇAMENTO COM, NO MÍNIMO, 03 FORNECEDORES ENQUADRADOS COMO MPE LOCAL OU REGIONAL OU, DE OUTRA FORMA, HÁ COMPROVAÇÃO DE QUE HÁ 03 FORNECEDORES MPE LOCAL OU REGIONAL?
    'orcamento' => [
        'Inexistência de, no mínimo, 03 (três) fornecedores competitivos enquadrados como ME ou EPP local ou regional' => 'Inexistência de, no mínimo, 03 (três) fornecedores competitivos enquadrados como ME ou EPP local ou regional',
        'Existência do mínimo de 03 MPE regional competitivos' => 'Existência do mínimo de 03 MPE regional competitivos',
        'Existência do mínimo de 03 MPE local competitivos' => 'Existência do mínimo de 03 MPE local competitivos'
    ], //VAI SER APLICADA RESTRIÇÃO TERRITORIAL?
    'retricao' => [
        'Não' => 'Não',
        'sim. Restrição regional' => 'sim. Restrição regional',
        'sim. Restrição local' => 'sim. Restrição local',
        'Outros' => 'Outros',
    ], //CARACTERÍSTICA DO CERTAME
    'certame' => [
        'Tradicional (Contrato)' => 'Tradicional (Contrato)',
        'Sistema registro de preços (Ata registro de preços)' => 'Sistema registro de preços (Ata registro de preços)'
    ], //FORMA DE SELEÇÃO
    'selecao' => [
        'Eletrônico' => 'Eletrônico',
        'Presencial' => 'Presencial',
        'Sem disputas' => 'Sem disputas',
        'Eletrônico via email' => 'Eletrônico via email',
        'Não se aplica(procedimento se, fase de disputa)' => 'Não se aplica(procedimento se, fase de disputa)'
    ], //ANALISE DE CONFORMIDADE DA PROPOSTA
    'proposta' => [
        'Não exigido' => 'Não exigido',
        'Amostra' => 'Amostra',
        'Exame de conformidade' => 'Exame de conformidade',
        'Prova de conceito' => 'Prova de conceito'
    ], //UNIDADE REQUISITANTE
    'requisitante' => [
        'Secretaria Municipal de Administração, Finanças e Des. Econômico' => 'Secretaria Municipal de Administração, Finanças e Des. Econômico',
        'Secretaria Municipal de Educação, Cultura e Esporte' => 'Secretaria Municipal de Educação, Cultura e Esporte',
        'Secretaria Municipal de Saúde' => 'Secretaria Municipal de Saúde',
        'Secretaria Municipal de Viações Obras e Urbanismo' => 'Secretaria Municipal de Viações Obras e Urbanismo',
        'Secretaria Municipal de Agricultura, Meio Ambiente e Turismo' => 'Secretaria Municipal de Agricultura, Meio Ambiente e Turismo',
        'Secretaria Municipal de Assistência Social' => 'Secretaria Municipal de Assistência Social',
        'Secretaria Municipal de Planejamento e Urbanismo' => 'Secretaria Municipal de Planejamento e Urbanismo',
        'Secretaria Municipal de Gabinete' => 'Secretaria Municipal de Gabinete'
    ]

];
