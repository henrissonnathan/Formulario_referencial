
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-6">
            <div class="card">
                
                    

                <div class="card-body">
                    <form name="formLogin" method="post" action="verification.php" data-parsley-validate="">
                        <label for="login">Digite seu email:</label>
                        <input type="text" name="login" id="login" class="form-control form-control-lg" required data-parsley-required-message="Preencha o login por favor">
                        <br>
                        <label for="senha">Digite sua senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control form-control-lg" required data-parsley-required-message="Preencha a senha por favor">
                        <br>
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i ></i> Efetuar Login
                        </button>
                    </form>
                </div>

            </div>
            <div class="text-center">
                <a class="btn btn-primary" href="paginas/cadastro">cadastrar conta</a>
            </div>

        </div>
    </div>
</div>