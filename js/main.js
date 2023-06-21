/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('customer');

    var modal = $(this);
    modal.find('.modal-title').text('Excluir Cliente #' + id);
    modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});

/**
 * MODIFICADO: Passa os dados do cliente para o Modal, e atualiza o link para exclusão (Motos)
 */
 $('#delete-modal-moto').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('moto');

    var modal = $(this);
    modal.find('.modal-title').text('Excluir Moto: #' + id);
    modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});

/**
 * MODIFICADO: Passa os dados do cliente para o Modal, e atualiza o link para exclusão (Contatos)
 */
$('#delete-modal-contato').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('contato');

    var modal = $(this);
    modal.find('.modal-title').text('Excluir Contato: #' + id);
    modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});

/**
 * MODIFICADO: Passa os dados do cliente para o Modal, e atualiza o link para exclusão (Brinquedos)
 */
$('#delete-modal-brinquedo').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('brinquedo');

    var modal = $(this);
    modal.find('.modal-title').text('Excluir Brinquedo: #' + id);
    modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});


/**
 * MODIFICADO: Passa os dados do cliente para o Modal, e atualiza o link para exclusão (Usuários)
 */
 $('#delete-modal-usuario').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('usuario');

    var modal = $(this);
    modal.find('.modal-title').text('Excluir Usuário: #' + id);
    modal.find('#confirm').attr('href', 'delete.php?id=' + id);
});


/**
 * MODIFICADO: não permitir números em UF
 */
$('#uf').keydown(function (e) {
    if (e.shiftKey || e.ctrlKey || e.altKey) {
        e.preventDefault();
    } else {
        var key = e.keyCode;
        if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
            e.preventDefault();
        }
    }
});

/**
 * MODIFICADO: Form Validations
 */ 
$("#nome").on("input", function () {
    if (validaNome($("#nome").val())) {
        // certo
        $("#nome").removeClass("is-invalid");
        $("#nome").addClass("is-valid");
    } else {
        // errado
        $("#nome").addClass("is-invalid");
        $("#nome").removeClass("is-valid");
    }
});
function validaNome(nome) {
    if (nome) {
        return true
    }
    return false
}

$("#cpf").on("input", function () {
    if (validaCPF($("#cpf").val())) {
        // certo
        $("#cpf").removeClass("is-invalid");
        $("#cpf").addClass("is-valid");
    } else {
        // errado
        $("#cpf").addClass("is-invalid");
        $("#cpf").removeClass("is-valid");
    }
});
function validaCPF(cpf) {
    if (cpf && (cpf.length == 11 || cpf.length == 14) && cpf.match(/^[0-9]+$/)) {
        return true
    }
    return false
}

$("#dataNascimento").on("input", function () {
    if (validaDataNascimento($("#dataNascimento").val())) {
        // certo
        $("#dataNascimento").removeClass("is-invalid");
        $("#dataNascimento").addClass("is-valid");
    } else {
        // errado
        $("#dataNascimento").addClass("is-invalid");
        $("#dataNascimento").removeClass("is-valid");
    }
});
function validaDataNascimento(data) {
    if (data) {
        return true
    }
    return false
}

$("#endereco").on("input", function () {
    if (validaEndereco($("#endereco").val())) {
        // certo
        $("#endereco").removeClass("is-invalid");
        $("#endereco").addClass("is-valid");
    } else {
        // errado
        $("#endereco").addClass("is-invalid");
        $("#endereco").removeClass("is-valid");
    }
});
function validaEndereco(endereco) {
    if (endereco) {
        return true
    }
    return false
}

$("#bairro").on("input", function () {
    if (validaBairro($("#bairro").val())) {
        // certo
        $("#bairro").removeClass("is-invalid");
        $("#bairro").addClass("is-valid");
    } else {
        // errado
        $("#bairro").addClass("is-invalid");
        $("#bairro").removeClass("is-valid");
    }
});
function validaBairro(bairro) {
    if (bairro) {
        return true
    }
    return false
}

$("#cep").on("input", function () {
    if (validaCEP($("#cep").val())) {
        // certo
        $("#cep").removeClass("is-invalid");
        $("#cep").addClass("is-valid");
    } else {
        // errado
        $("#cep").addClass("is-invalid");
        $("#cep").removeClass("is-valid");
    }
});
function validaCEP(cep) {
    if (cep && cep.length == 8 && cep.match(/^[0-9]+$/)) {
        console.log(cep && cep.length == 8 && cep.match(/^[0-9]+$/))
        return true
    }
    return false
}

$("#municipio").on("input", function () {
    if (validaMunicipio($("#municipio").val())) {
        // certo
        $("#municipio").removeClass("is-invalid");
        $("#municipio").addClass("is-valid");
    } else {
        // errado
        $("#municipio").addClass("is-invalid");
        $("#municipio").removeClass("is-valid");
    }
});
function validaMunicipio(municipio) {
    if (municipio) {
        return true
    }
    return false
}

$("#telefone").on("input", function () {
    if (validaTelefone($("#telefone").val())) {
        // certo
        $("#telefone").removeClass("is-invalid");
        $("#telefone").addClass("is-valid");
    } else {
        // errado
        $("#telefone").addClass("is-invalid");
        $("#telefone").removeClass("is-valid");
    }
});
function validaTelefone(tel) {
    if (tel && (tel.length == 10 || tel.length == 11) && tel.match(/^[0-9]+$/)) {
        return true
    }
    return false
}

$("#celular").on("input", function () {
    if (validaTelefone($("#celular").val())) {
        // certo
        $("#celular").removeClass("is-invalid");
        $("#celular").addClass("is-valid");
    } else {
        // errado
        $("#celular").addClass("is-invalid");
        $("#celular").removeClass("is-valid");
    }
});

$("#uf").on("input", function () {
    if (validaUF($("#uf").val())) {
        // certo
        $("#uf").removeClass("is-invalid");
        $("#uf").addClass("is-valid");
    } else {
        // errado
        $("#uf").addClass("is-invalid");
        $("#uf").removeClass("is-valid");
    }
});
function validaUF(uf) {
    if (uf && uf.length == 2 && uf.match(/^[a-zA-Z]+$/)) {
        return true
    }
    return false
}

$("#ie").on("input", function () {
    if (validaIE($("#ie").val())) {
        // certo
        $("#ie").removeClass("is-invalid");
        $("#ie").addClass("is-valid");
    } else {
        // errado
        $("#ie").addClass("is-invalid");
        $("#ie").removeClass("is-valid");
    }
});
function validaIE(ie) {
    if (ie && ie.length >= 9 && ie.length <= 14 && ie.match(/^[0-9]+$/)) {
        return true
    }
    return false
}


// Moto

$("#codigoMoto").on("input", function () {
    if (validaCodigoMoto($("#codigoMoto").val())) {
        // certo
        $("#codigoMoto").removeClass("is-invalid");
        $("#codigoMoto").addClass("is-valid");
    } else {
        // errado
        $("#codigoMoto").addClass("is-invalid");
        $("#codigoMoto").removeClass("is-valid");
    }
});
function validaCodigoMoto(cod) {
    if (cod && cod.length == 11 && cod.match(/^[0-9]+$/)) {
        return true
    }
    return false
}

$("#nomeMoto").on("input", function () {
    if (validaNomeMoto($("#nomeMoto").val())) {
        // certo
        $("#nomeMoto").removeClass("is-invalid");
        $("#nomeMoto").addClass("is-valid");
    } else {
        // errado
        $("#nomeMoto").addClass("is-invalid");
        $("#nomeMoto").removeClass("is-valid");
    }
});
function validaNomeMoto(nome) {
    if (nome) {
        return true
    }
    return false
}

$("#fabricanteMoto").on("input", function () {
    if (validaFabricanteMoto($("#fabricanteMoto").val())) {
        // certo
        $("#fabricanteMoto").removeClass("is-invalid");
        $("#fabricanteMoto").addClass("is-valid");
    } else {
        // errado
        $("#fabricanteMoto").addClass("is-invalid");
        $("#fabricanteMoto").removeClass("is-valid");
    }
});
function validaFabricanteMoto(fabricante) {
    if (fabricante) {
        return true
    }
    return false
}

$("#anoMoto").on("input", function () {
    if (validaAnoMoto($("#anoMoto").val())) {
        // certo
        $("#anoMoto").removeClass("is-invalid");
        $("#anoMoto").addClass("is-valid");
    } else {
        // errado
        $("#anoMoto").addClass("is-invalid");
        $("#anoMoto").removeClass("is-valid");
    }
});
function validaAnoMoto(ano) {
    if (ano && ano.length == 4 && ano.match(/^[0-9]+$/)) {
        return true
    }
    return false
}

$("#precoMoto").on("input", function () {
    if (validaPrecoMoto($("#precoMoto").val())) {
        // certo
        $("#precoMoto").removeClass("is-invalid");
        $("#precoMoto").addClass("is-valid");
    } else {
        // errado
        $("#precoMoto").addClass("is-invalid");
        $("#precoMoto").removeClass("is-valid");
    }
});
function validaPrecoMoto(preco) {
    if (preco && preco.match(/^[0-9].*$/)) {
        return true
    }
    return false
}

$("#coresMoto").on("input", function () {
    if (validaCoresMoto($("#coresMoto").val())) {
        // certo
        $("#coresMoto").removeClass("is-invalid");
        $("#coresMoto").addClass("is-valid");
    } else {
        // errado
        $("#coresMoto").addClass("is-invalid");
        $("#coresMoto").removeClass("is-valid");
    }
});
function validaCoresMoto(cores) {
    if (cores) {
        return true
    }
    return false
}

$("#fabricacaoMoto").on("input", function () {
    if (validaFabricacaoMoto($("#fabricacaoMoto").val())) {
        // certo
        $("#fabricacaoMoto").removeClass("is-invalid");
        $("#fabricacaoMoto").addClass("is-valid");
    } else {
        // errado
        $("#fabricacaoMoto").addClass("is-invalid");
        $("#fabricacaoMoto").removeClass("is-valid");
    }
});
function validaFabricacaoMoto(data) {
    if (data) {
        return true
    }
    return false
}

$("input#imagemMoto").change(function () {
    if (validaImagemMoto($(this).val())) {
        // certo
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    } else {
        // errado
        $(this).addClass("is-invalid");
        $(this).removeClass("is-valid");
    }
});

function validaImagemMoto(path) {
    if (path.endsWith(".png") || path.endsWith(".jpg") || path.endsWith(".jpeg") || path.endsWith(".gif")) {
        return true
    }
    return false
}

$("#nomeUsuario").on("input", function () {
    if (validaNomeUsuario($("#nomeUsuario").val())) {
        // certo
        $("#nomeUsuario").removeClass("is-invalid");
        $("#nomeUsuario").addClass("is-valid");
    } else {
        // errado
        $("#nomeUsuario").addClass("is-invalid");
        $("#nomeUsuario").removeClass("is-valid");
    }
});
function validaNomeUsuario(nome) {
    if (nome) {
        return true
    }
    return false
}

$("#loginUsuario").on("input", function () {
    if (validaLoginUsuario($("#loginUsuario").val())) {
        // certo
        $("#loginUsuario").removeClass("is-invalid");
        $("#loginUsuario").addClass("is-valid");
    } else {
        // errado
        $("#loginUsuario").addClass("is-invalid");
        $("#loginUsuario").removeClass("is-valid");
    }
});
function validaLoginUsuario(login) {
    if (login) {
        return true
    }
    return false
}

$("#senhaUsuario").on("input", function () {
    if (validaSenhaUsuario($("#senhaUsuario").val())) {
        // certo
        $("#senhaUsuario").removeClass("is-invalid");
        $("#senhaUsuario").addClass("is-valid");
    } else {
        // errado
        $("#senhaUsuario").addClass("is-invalid");
        $("#senhaUsuario").removeClass("is-valid");
    }
});
function validaSenhaUsuario(senha) {
    if (senha && senha.length >= 8) {
        return true
    }
    return false
}

$("input#imagemUsuario").change(function () {
    if (validaImagemUsuario($(this).val())) {
        // certo
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    } else {
        // errado
        $(this).addClass("is-invalid");
        $(this).removeClass("is-valid");
    }
});

function validaImagemUsuario(path) {
    if (path == "") {
        return true
    }
    if (path.endsWith(".png") || path.endsWith(".jpg") || path.endsWith(".jpeg") || path.endsWith(".gif")) {
        return true
    }
    return false
}


// Contato

$("#nomeContato").on("input", function () {
    if (validaNomeContato($("#nomeContato").val())) {
        // certo
        $("#nomeContato").removeClass("is-invalid");
        $("#nomeContato").addClass("is-valid");
    } else {
        // errado
        $("#nomeContato").addClass("is-invalid");
        $("#nomeContato").removeClass("is-valid");
    }
});
function validaNomeContato(nome) {
    if (nome) {
        return true
    }
    return false
}

$("#emailContato").on("input", function () {
    if (validaEmailContato($("#emailContato").val())) {
        // certo
        $("#emailContato").removeClass("is-invalid");
        $("#emailContato").addClass("is-valid");
    } else {
        // errado
        $("#emailContato").addClass("is-invalid");
        $("#emailContato").removeClass("is-valid");
    }
});
function validaEmailContato(email) {
    return String(email).toLowerCase().match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

$("#telefoneContato").on("input", function () {
    if (validaTelefoneContato($("#telefoneContato").val())) {
        // certo
        $("#telefoneContato").removeClass("is-invalid");
        $("#telefoneContato").addClass("is-valid");
    } else {
        // errado
        $("#telefoneContato").addClass("is-invalid");
        $("#telefoneContato").removeClass("is-valid");
    }
});
function validaTelefoneContato(tel) {
    if (tel && (tel.length == 10 || tel.length == 11) && tel.match(/^[0-9]+$/)) {
        return true
    }
    return false
}

$("#funcaoContato").on("input", function () {
    if (validaFuncaoContato($("#funcaoContato").val())) {
        // certo
        $("#funcaoContato").removeClass("is-invalid");
        $("#funcaoContato").addClass("is-valid");
    } else {
        // errado
        $("#funcaoContato").addClass("is-invalid");
        $("#funcaoContato").removeClass("is-valid");
    }
});
function validaFuncaoContato(funcao) {
    if (funcao) {
        return true
    }
    return false
}


// Brinquedo

$("#nomeBrinquedo").on("input", function () {
    if (validaNomeBrinquedo($("#nomeBrinquedo").val())) {
        // certo
        $("#nomeBrinquedo").removeClass("is-invalid");
        $("#nomeBrinquedo").addClass("is-valid");
    } else {
        // errado
        $("#nomeBrinquedo").addClass("is-invalid");
        $("#nomeBrinquedo").removeClass("is-valid");
    }
});
function validaNomeBrinquedo(nome) {
    if (nome) {
        return true
    }
    return false
}

$("#marcaBrinquedo").on("input", function () {
    if (validaMarcaBrinquedo($("#marcaBrinquedo").val())) {
        // certo
        $("#marcaBrinquedo").removeClass("is-invalid");
        $("#marcaBrinquedo").addClass("is-valid");
    } else {
        // errado
        $("#marcaBrinquedo").addClass("is-invalid");
        $("#marcaBrinquedo").removeClass("is-valid");
    }
});
function validaMarcaBrinquedo(marca) {
    if (marca) {
        return true
    }
    return false
}

$("#faixaEtariaBrinquedo").on("input", function () {
    if (validaFaixaEtariaBrinquedo($("#faixaEtariaBrinquedo").val())) {
        // certo
        $("#faixaEtariaBrinquedo").removeClass("is-invalid");
        $("#faixaEtariaBrinquedo").addClass("is-valid");
    } else {
        // errado
        $("#faixaEtariaBrinquedo").addClass("is-invalid");
        $("#faixaEtariaBrinquedo").removeClass("is-valid");
    }
});
function validaFaixaEtariaBrinquedo(numero) {
    if (0 <= parseInt(numero) && parseInt(numero) <= 99) {
        return true
    }
    return false
}

$("input#imagemBrinquedo").change(function () {
    if (validaImagemBrinquedo($(this).val())) {
        // certo
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    } else {
        // errado
        $(this).addClass("is-invalid");
        $(this).removeClass("is-valid");
    }
});

function validaImagemBrinquedo(path) {
    if (path.endsWith(".png") || path.endsWith(".jpg") || path.endsWith(".jpeg") || path.endsWith(".gif") || path.endsWith(".webp")) {
        return true
    }
    return false
}


/*
$("form").submit(function(event) {
    $('.is-invalid').each(function(){           
        if($(this).height() < 50) {
            event.preventDefault();
            event.stopPropagation();
        }
    });
    
});
*/

$(document).ready(function() {
    $('.form-check-input').removeAttr("disabled");
    $('.form-check-input').click(function() {
        $('.form-check-input').not(this).prop('checked', false);
        
        if ($('.form-check-input:checked').length == 0) return false;
    });
});