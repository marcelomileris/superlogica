<!doctype html>
<html lang="en">
<head>
<style>
    body {
        padding: 10px 10px;
    }

</style>
<title></title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
<div class="row">
    <div class="col-md-6">
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-md-12 control-label" for="txtUser">Nome do usuário:</label>  
                <div class="col-md-12">
                    <input id="name" name="name" type="text" placeholder="Nome do usuário" class="form-control input-md">  
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="txtUser">Nome do login:</label>  
                <div class="col-md-12">
                    <input id="userName" name="userName" type="text" placeholder="Nome do login" class="form-control input-md">  
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="txtUser">CEP:</label>  
                <div class="col-md-12">
                    <input id="zipCode" name="zipCode" type="text" placeholder="Cep" class="form-control input-md">              
                </div>
                <div class="col-md-12">
                    <span class="help-block" id="zipCodeStr"></span>  
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="txtUser">Número do telefone:</label>  
                <div class="col-md-12">
                    <input id="phoneNumber" name="phoneNumber" type="text" placeholder="Número do telefone" class="form-control input-md">  
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="txtUser">Email:</label>  
                <div class="col-md-12">
                    <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md">  
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="txtUser">Senha:</label>  
                <div class="col-md-12">
                    <input id="password" name="password" type="password" placeholder="Senha" class="form-control input-md">  
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="button" id="btnSave" name="btnSave" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <label>Log</label>
        <textarea id="result" name="result" rows="5" style="width:100%" disabled="disabled" class="form-control input-md"></textarea>
        <hr/>
        <label>Url</label><br/>
        <input type="text" id="url" name="url" class="form-control input-md" value="http://localhost/api/"/><br/>
        <label>Parâmetros</label><br/>
        <textarea id="params" name="params" rows="5" style="width:100%" class="form-control input-md">
{
"name" : "Marcelo Mileris"
}
        </textarea><br/>
        <input type="text" id="rescurl" name="rescurl" disabled class="form-control" /><br/>
        <button type="button" id="btnCurl" name="btnCurl" class="btn btn-primary">Enviar</button>
    </div>
</div>



</body>

<script src="//unpkg.com/vanilla-masker@1.1.1/build/vanilla-masker.min.js"></script>
<script src="script.js"></script>

</html>