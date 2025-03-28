         <!-- Botões de navegação -->
         <div class="botoes-navegacao mt-4">
                            <button type="button" class="btn btn-secondary anterior">◀ Anterior</button>
                            <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                        </div>
                    </div>
                    <!--etapa 4
             Modalidade
            <label for="modalidade">MODALIDADE</label>
            <select name="modalidade" id="modalidade" class="form-control borda  toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#modal" data-toggle-values='["Licitação","Inexigibilidade e licitação","Chamamento público",""]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['modalidade'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>



                    etapa 5
            Critério
            <div id="modal" class="toggleable-field" style="display: none;">
                <label for="criterio">CRITÉRIO DE ADJUDICAÇÃO DO OBJETO</label>
                <select name="criterio" id="criterio" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                    <option value="">Selecione uma opção</option>
                    <?php foreach ($selectOptions['criterio'] as $value => $label): ?>
                        <option value="<?= $value ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

                            etapa 6
            trata de licitações,etc.
            <label for="trata">TRATA-SE DE LICITAÇÕES DECORRENTE DE CONVÊNIO/CONTRATO DE REPASSE/OUTROS COM GOVERNO ESTADUAL/FEDERAL?</label>
            <select name="trata" id="trata" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['trata'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

                    etapa 7  
            definisão de quantidade
            <label for="levantamento">COMO FORAM DEFINIDAS AS QUANTIDADES</label>
            <select name="levantamento" id="levantamento" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#leve" data-toggle-values='["Outros"]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['levantamento'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

            <div id="leve" class="toggleable-field" style="display: none;">
                <label for="leve-outro">Informe como foram definidas as quantidades</label>
                <input type="text" name="leve-outro" id="leve-outro" class="form-control borda" placeholder="Informe como foram definidas as quantidades">
            </div>



                    etapa 8
            definisão de quantidade
            <label for="parametro">PARÂMETRO UTILIZADO PARA OBTENÇÃO DO VALOR DE REFERÊNCIA:</label>
            <select name="parametro" id="parametro" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['parametro'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
                        etapa 9
            PARÂMETRO UTILIZADO PARA OBTENÇÃO DO VALOR DE REFERÊNCIA
            <label>FONTES DE PESQUISA </label>
             Container dos parâmetros 
            <div id="fontes-container">
                 Linha 1 
                <div class="input-group mb-2 fonte-item">
                    <select name="fonte[]" class="form-control borda toggle-trigger" required
                        data-parsley-required-message="Por favor, selecione uma opção">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($selectOptions['fonte'] as $value => $label): ?>
                            <option value="<?= $value ?>"><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-danger remover-fonte" disabled>
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                 Linha 2 (mínimo obrigatório) 
                <div class="input-group mb-2 fonte-item">
                    <select name="fonte[]" class="form-control borda" required
                        data-parsley-required-message="Por favor, selecione uma opção">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($selectOptions['fonte'] as $value => $label): ?>
                            <option value="<?= $value ?>"><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-danger remover-fonte">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

             Botão para adicionar mais linhas 
            <button type="button" id="adicionar-fonte" class="btn btn-primary btn-sm mt-2">
                <i class="fas fa-plus"></i> Adicionar Parâmetro
            </button>

                            etapa 10
            Orçamento fas fa-ca
            <label for="orcamento">FOI OBTIDO ORÇAMENTO COM, NO MÍNIMO, 03 FORNECEDORES ENQUADRADOS COMO MPE LOCAL OU REGIONAL OU, DE OUTRA FORMA, HÁ COMPROVAÇÃO DE QUE HÁ 03 FORNECEDORES MPE LOCAL OU REGIONAL?</label>
            <select name="orcamento" id="orcamento" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['orcamento'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
                   etapa11
            retrisão territorial 
            <label for="retricao">VAI SER APLICADA RESTRIÇÃO TERRITORIAL?</label>
            <select name="retricao" id="retricao" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#terri" data-toggle-values='["sim. Restrição regional","sim. Restrição local","Outros"]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['retricao'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <div id="terri" class="toggleable-field" style="display: none;">
                <label for="restri-expli">Justifique</label>
                <input type="text" name="restri-expli" id="restri-expli" class="form-control borda" placeholder="justifique">
            </div>



                etapa 12

            CARACTERÍSTICA DO CERTAME
            <label for="certame">CARACTERÍSTICA DO CERTAME:</label>
            <select name="certame" id="certame" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['certame'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

                        etapa 13
            FORMA DE SELEÇÃO*
            <label for="selecao">FORMA DE SELEÇÃO:</label>
            <select name="selecao" id="selecao" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#selecasta" data-toggle-values='["Presencial","Sem disputas"]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['selecao'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <div id="selecasta" class="toggleable-field" style="display:none;">
                <label for="seleca-esxpli">justifique</label>
                <input type="text" name="seleca-expli" id="seleca-expli" class="form-control borda" placeholder="justifique">
            </div>



                        etapa 14
            ANALISE DE CONFORMIDADE DA PROPOSTA*
            <label for="proposta">ANALISE DE CONFORMIDADE DA PROPOSTA:</label>
            <select name="proposta" id="proposta" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#propostaas" data-toggle-values='["Amostra","Exame de conformidade","Prova de conceito"]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['proposta'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <div id="propostaas" class="toggleable-field" style="display: nene;">
                <label for="propos-expli">Defina os quesitos</label>
                <input type="text" name="propos-expli" id="propos-expli" class="form-control borda" placeholder="justifique">
            </div>

                    etapa 15
            justificativa
            <label for="justificativa">JUSTIFICATIVA DA CONTRATAÇÃO:</label>
            <input type="text" name="justificativa" id="justificativa" class="form-control borda" placeholder="Digite a justificativa" required data-parsley-required-message="Por favor, preencha o justificativa">
            
                    etapa 16
            condiçoes específicas do objeto
            <label for="condicoes">CONDIÇÕES ESPECÍFICAS DO OBJETO (detalhamento completo do objeto)</label>
            <input type="text" name="condicoes" id="condicoes" class="form-control borda" placeholder="Digite a condicoes" required data-parsley-required-message="Por favor, preencha o condicoes">
            
                    etapa 17
            prazo de vigência do(a) sistema registro de preços
            <label for="prazo">PRAZO DE VIGÊNCIA DO(A) SISTEMA REGISTRO DE PREÇOS (ATA REGISTRO DE PREÇOS)</label>
            <input type="text" name="prazo" id="prazo" class="form-control borda" placeholder="Digite a prazo" required data-parsley-required-message="Por favor, preencha o prazo">
             etapa 18
            PRAZO DE EXECUÇÃO
            <label for="execucao">DETALHE COMO DEVE SER O PRAZO DE EXECUÇÃO - PRAZO MÁXIMO PARA INICIAR E PRAZO PARA CONCLUSÃO</label>
            <input type="text" name="execucao" id="execucao" class="form-control borda" placeholder="Digite a execucao" required data-parsley-required-message="Por favor, preencha o execucao">
             etapa 19
            LOCAL DE EXECUÇÃO
            <label for="local">LOCAL DE EXECUÇÃO</label>
            <input type="text" name="local" id="local" class="form-control borda" placeholder="Digite a local" required data-parsley-required-message="Por favor, preencha o local">


                        etapa 20
             UNIDADE REQUISITANTE 
            <div class="mb-3">
                <label for="proposta" class="form-label">UNIDADE REQUISITANTE</label>
                <select name="proposta" id="proposta" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opção">
                    <option value="">Selecione uma opção</option>
                    <?php foreach ($selectOptions['requisitante'] as $value => $label): ?>
                        <option value="<?= $value ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

             RESPONSÁVEL PELO ETP 
            <div class="mb-3">
                <label class="form-label">RESPONSÁVEL PELO ETP</label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="matricula_etp" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula_etp" id="matricula_etp">
                    </div>
                    <div class="col-md-6">
                        <label for="nome_etp" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome_etp" id="nome_etp">
                    </div>
                </div>
            </div>

             RESPONSÁVEL PELO DFD 
            <div class="mb-3">
                <label class="form-label">RESPONSÁVEL PELO DFD</label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="matricula_dfd" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula_dfd" id="matricula_dfd">
                    </div>
                    <div class="col-md-6">
                        <label for="nome_dfd" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome_dfd" id="nome_dfd">
                    </div>
                </div>
            </div>

             RESPONSÁVEL PELO LEVANTAMENTO DE PREÇO 
            <div class="mb-3">
                <label class="form-label">RESPONSÁVEL PELO LEVANTAMENTO DE PREÇO</label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="matricula_preco" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula_preco" id="matricula_preco">
                    </div>
                    <div class="col-md-6">
                        <label for="nome_preco" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome_preco" id="nome_preco">
                    </div>
                </div>
            </div>



            <br>
                    
                      etapa 21
            PRAZO DE EXECUÇÃO
            
            <label for="data">DATA E ASSINATURA</label>
            <input type="text" name="data" id="data" class="form-control borda" placeholder="Digite a datae e assinatura" required data-parsley-required-message="Por favor, preencha o compo">