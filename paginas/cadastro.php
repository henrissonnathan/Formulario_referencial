<?php
if (!isset($pagina)) {
    exit;
}
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-6">
            <div class="card">
                
                <div class="card-body">
                    <form name="formLogin" method="post" action="salvar/salvar" data-parsley-validate="">
                    <label for="login">Digite seu nome de usuario:</label>
                        <input type="text" name="nome" id="nome" class="form-control form-control-lg" required data-parsley-required-message="Preencha o usuario por favor">
                        <br>
                        <label for="login">Digite seu email:</label>
                        <input type="text" name="login" id="login" class="form-control form-control-lg" required data-parsley-required-message="Preencha o login por favor">
                        <br>
                        <label for="senha">Digite sua senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control form-control-lg" required data-parsley-required-message="Preencha a senha por favor">
                        <br>
                        <label for="senha">comfirme sua senha:</label>
                        <input type="password" name="senhaC" id="senhaC" class="form-control form-control-lg" required data-parsley-required-message="Preencha a senha por favor">
                        <br>
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i ></i> cadastrar conta
                        </button>
                    </form>
                </div>
                <div class="text-center">
                <a class="btn btn-primary" href="paginas/login">login</a>
            </div>
            </div>
        </div>
    </div>
</div>