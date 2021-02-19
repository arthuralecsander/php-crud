
var listaPessoas = {
    pessoas: []
}; //init array de pessoas

function submitPai(event) {
    event.preventDefault();
    const data = new FormData(event.target);
    const formJSON = Object.fromEntries(data.entries());
    listaPessoas.pessoas.push({
        nome: formJSON.nome,
        filhos: [],
    });
    atualizarLista();
    listarPessoas(formJSON.nome, listaPessoas.pessoas.length - 1);
} //Insere o pai ao array

function submitFilho(event, i) {
    event.preventDefault();
    const data = new FormData(event.target);
    const formJSON = Object.fromEntries(data.entries());
    listaPessoas.pessoas[i].filhos.push({
        nome: formJSON.nome,
    });
    atualizarLista();
    listarFilhos(formJSON.nome, i, listaPessoas.pessoas[i].filhos.length - 1);
} //Insere o filho ao array

function atualizarLista() {
    const results = document.querySelector('.results textarea');
    results.innerHTML = JSON.stringify(listaPessoas, null, 4);
} //Atualiza o textArea do html

function removerPai(id) {

    if (listaPessoas.pessoas[id].filhos.length > 0) {
        for (var i = 0; i <= listaPessoas.pessoas[id].filhos.length; i++) {
            removerFiho(id, i);
        }
    }
    console.log(listaPessoas);
    listaPessoas.pessoas.splice(id, 1);
    atualizarLista();
    removerPessoasLista('paiId' + id);
}


//Metodo de excluir pai

function removerFiho(idpai, idfilho) {
    removerPessoasLista('paiId' + idpai + 'filhoId' + idfilho);
    listaPessoas.pessoas[idpai].filhos.splice(idfilho, 1);
    atualizarLista();
} //Metodo de excluir filho

function listarPessoas(name, id) {
    const text =
            `<tr id="paiId${id}">
                <td>${name}</td>
                <td>
                    <form id="formFilho" onsubmit="submitFilho(event,${id})" > 
                        <div class='input-group mb-3 marginRight'>
                            <label class='input-group-text'>Nome do filho:</label><br>
                            <input type='text' name='nome' id='nome' class='form-control'><br> 
                            <div class="marginLeft">
                                <button type='submit' class="btn btn-primary">Adicionar</button>   
                                <button type='button' onclick="removerPai(${id})" class="btn btn-primary">Remover</button>
                            </div>    
                        
                        </div>

                    </form>    
                </td>
            </tr>`;
    const position = "beforeend";
    const tbPessoaNomes = document.querySelector('#tbPessoa');
    tbPessoaNomes.insertAdjacentHTML(position, text);
} //Insere o html na pagina para cada pessoa(pai) adicionado

function listarFilhos(name, idpai, idfilho) {
    const text =
            `<tr id="paiId${idpai}filhoId${idfilho}">          
                    <td>Filho ${name}</td>
                    <td>
                        <div class='form-group'>        
                            <button type='button' onclick="removerFiho(${idpai},${idfilho})" class="btn btn-primary">Remover</button>   
                         </div>
                    </td>
            </tr>`;
    const position = "afterend";
    const tbPessoaNomes = document.querySelector('#paiId' + idpai);
    tbPessoaNomes.insertAdjacentHTML(position, text);
} //Insere o html na pagina para cada filho adicionado

function removerPessoasLista(element) {
    var myobj = document.getElementById(element);
    myobj.remove();
} //remove o html da pessoa indicada

function gravarLista() {

    const lista = JSON.stringify(listaPessoas.pessoas);
    var formData = new FormData();
    formData.append('text', lista);

    fetch('process.php', {
        method: 'post',
        body: formData
    }).then(function (response) {
        return response.text();
    }).then(function (text) {
        console.log(text);
    }).catch(function (error) {
        console.error(error);
    })

} //fetch que envia para o php POST

function lerLista() {

    const textArea = document.getElementById('textjson');
    fetch('process.php', {
        method: 'get'
    }).then(function (response) {
        return response.text();
    }).then(function (text) {
        var arrayJson = JSON.parse(text);
        var indexPessoas = 0;

        for (var i = 0; i < arrayJson.length; i++) {
            if (arrayJson[i].idpai != null) {
                listaPessoas.pessoas.push({
                    nome: arrayJson[i].nome,
                    filhos: [],
                });
                atualizarLista();
                listarPessoas(arrayJson[i].nome, listaPessoas.pessoas.length - 1);


                for (var j = 0; j < arrayJson.length; j++) {

                    if ((arrayJson[j].fk_idpai != null) && (arrayJson[j].fk_idpai === arrayJson[i].idpai)) {
                        listaPessoas.pessoas[indexPessoas].filhos.push({
                            nome: arrayJson[j].nome,
                        });
                        atualizarLista();
                        listarFilhos(arrayJson[j].nome, indexPessoas, listaPessoas.pessoas[indexPessoas].filhos.length - 1);
                    }
                }
                indexPessoas++;
            }
        }
    }).catch(function (error) {
        console.error(error);
    })

} //fetch que recebe o fetch GET do php
