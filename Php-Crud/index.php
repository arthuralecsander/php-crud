<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="myscripts.js"></script><!-- Import dos scripts -->
        <link rel="stylesheet" href="styles.css"> <!-- import css -->
        <title>Turim Project</title>
    </head>
    <body>


        <div class="split right marginRight"> <!-- Area da tabela -->
            <table class="table">
                <thead>
                <th>Nome dos pais</th> 
                <th colspan="2">Acoes</th>
                </thead>
                <tbody id="tbPessoa">
                </tbody>
            </table>
        </div>

        <div class="split left marginLeft">
            <div >
                <form id="formPai" onsubmit="submitPai(event)" >  <!-- Form referente ao pai -->
                    <h2>Formulario</h2>
                    <div class='input-group mb-3 '>
                        <label class='input-group-text'>Nome do pai:</label><br>
                        <input  type='text' name='nome' class='form-control'><br>  
                        <div class='form-group' style="margin-right: 25%">
                            <button type='submit' class='btn btn-primary' name="save">Adicionar</button>   
                        </div>
                    </div>

                </form>
                <div class='form-group results'>
                    <div class="results">
                        <h2>Json Gerado</h2> <!-- TextArea do JSON -->
                        <p id="jsontext"></p>
                        <form name='formjson' action='process.php' method='POST'>
                            <textarea id='textjson' name='text' rows="10" cols="100">
                            </textarea>
                            <div >
                                <div class='form-group'>
                                    <button onclick='gravarLista()' type='button' class='btn btn-primary'>Gravar </button> <!-- Botao gravar no banco -->
                                    <button onclick="lerLista()" type='button' class='btn btn-primary marginLeft'>Ler</button>    <!-- Botao gravar no leitura -->
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class='d-flex justify-content-center'>



            </div>
            <div class='d-flex justify-content-center'>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>