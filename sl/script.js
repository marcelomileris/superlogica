// Máscara dos campos CEP e Telefone
function inputMask(masks, max, event) {
	var c = event.target
	var v = c.value.replace(/\D/g, '')
	var m = c.value.length > max ? 1 : 0
	VMasker(c).unMask()
	VMasker(c).maskPattern(masks[m])
	c.value = VMasker.toPattern(v, masks[m])
}
/* *********************************************************************************** */
// Realiza uma pesquisa no viacep para retornar o endereço
function getZip() {
    let zipValue = document.querySelector("#zipCode").value.replace('.','').replace('-','')
    if (zipValue != "") {
        fetch('http://viacep.com.br/ws/'+zipValue+'/json/', {
            method: 'get' 
        })
        .then(function(res){
            return res.json()
        }) 
        .then(function(data) {
            if (!data.erro) {
                var res = document.querySelector("#zipCodeStr");
                res.innerHTML = `${data.logradouro}, ${data.bairro}, ${data.localidade}/${data.uf}`
                console.log(data)
           }
        })
    }
}
/* *********************************************************************************** */
// Atribui o evento ao campo de cep
var zipCode = document.querySelector("#zipCode")
zipCode.addEventListener("focusout", getZip)
/* *********************************************************************************** */
// Mascara para o cep
var zipMask = ['99.999-999']
var zip = document.querySelector('#zipCode')
VMasker(zip).maskPattern(zipMask[0])
zip.addEventListener('input', inputMask.bind(undefined, zipMask, 14), false)
/* *********************************************************************************** */
//Mascara para o telefone
var telMask = ['(99) 9999-99999', '(99) 99999-9999']
var tel = document.querySelector('#phoneNumber')
VMasker(tel).maskPattern(telMask[0])
tel.addEventListener('input', inputMask.bind(undefined, telMask, 14), false)

/* *********************************************************************************** */
// Valida os campos, realizando uma chamada ao método da classe validate
function validateFields() {
    var name = document.querySelector("#name")
    var user = document.querySelector("#userName")
    var zip = document.querySelector("#zipCode")
    var phone = document.querySelector("#phoneNumber")
    var email = document.querySelector("#email")
    var pass = document.querySelector("#password")
    var res = document.querySelector("#zipCodeStr")
    var data = {
        name : name.value,
        user : user.value,
        zipcode : zip.value.replace('.','').replace('-',''),
        phone : phone.value,
        email : email.value,
        password : pass.value
    }
    console.log(data);
    fetch('validate.php', {
        method: 'post' ,
        body: JSON.stringify(data),
        headers: {"Content-type": "application/json; charset=UTF-8"}
    })
    .then(function(res){
        return res.json()
    }) 
    .then(function(data) {
        document.querySelector("#result").innerHTML = ''
        if (data.success=="false"){
            document.querySelector("#result").innerHTML = data.msg
            console.log("resultado: " + data.msg)
            name.value = ''
            user.value = ''
            zipcode.value = ''
            phone.value = ''
            email.value = ''
            password.value = ''
            res.innerHTML = ''
        } else {
            document.querySelector("#result").innerHTML = data.msg
        }
        
    })
    .catch(err => console.log("Err: " + err))
}
var btn = document.querySelector("#btnSave");
btn.addEventListener("click", validateFields);
/* *********************************************************************************** */
// Realiza uma chamada ao método curl, enviando uma url e um json com o campos a serem pesquisados
function getCurl() {
    var url = document.querySelector("#url")
    var params = document.querySelector("#params")
    var rescurl = document.querySelector("#rescurl")
    var data = {
        url : url.value,
        params : params.value,
    }
    console.log(data);
    fetch('curl.php', {
        method: 'post' ,
        body: JSON.stringify(data),
        headers: {"Content-type": "application/json; charset=UTF-8"}
    })
    .then(function(res){
        return res.text()
    }) 
    .then(function(data) {
        console.log(data)        
        rescurl.value = data       
    })
    .catch(err => console.log("Err: " + err))   
}
var btnCurl = document.querySelector("#btnCurl");
btnCurl.addEventListener("click", getCurl);
/* *********************************************************************************** */