/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

function calcularTotal(quantidade) {
    let valor = document.querySelector("#valor").value;

    if (quantidade <= 0) {
        Swal.fire({
            title: 'Erro',
            text: 'Digite um valor positivo',
        })
        $("#quantidade").val("");
    }
    else if (valor != "") {
        valor = Number(valor.replace(/\D/g, '')) / 100;
        let total = quantidade * valor;
        total = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        document.querySelector("#total").value = total;
    }
}

$(document).ready(function () {
    let currentStep = 1;

    $('.proximo').click(function () {
        if (validarPasso(currentStep)) {
            mudarPasso(currentStep + 1);
        }
    });

    $('.anterior').click(function () {
        mudarPasso(currentStep - 1);
    });

    $('.opcao-box').click(function () {
        $(this).siblings().removeClass('selecionada');
        $(this).addClass('selecionada');
        const valor = $(this).data('resposta');
        $(this).siblings('input').val(valor);

        const target = $(this).closest('.pergunta').data('toggle-target');
        if (target) {
            const deveMostrar = $(this).data('toggle-values').includes(valor);
            $(target).toggle(deveMostrar);
        }
    });

    function mudarPasso(novoPasso) {
        $(`.step[data-step="${currentStep}"]`).removeClass('active');
        currentStep = novoPasso;
        $(`.step[data-step="${currentStep}"]`).addClass('active');
    }

    function validarPasso(passo) {
        let valido = true;
        $(`.step[data-step="${passo}"] [required]`).each(function () {
            if (!$(this).val()) {
                $(this).closest('.pergunta').find('.erro-validacao').show();
                valido = false;
            }
        });
        return valido;
    }
});
