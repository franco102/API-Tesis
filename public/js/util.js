// import * as SecurityProvider from './../providers/security.js';

class Util {
    static currentLanguage = 'es';
    static isMobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));


    static Browser_DOM(html, scope) {
        // Creates empty node and injects html string using .innerHTML 
        // in case the variable isn't a string we assume is already a node
        var node;
        if (html.constructor === String) {
            var node = document.createElement('div');
            node.innerHTML = html;
        } else {
            node = html;
        }

        // Creates of uses and object to which we will create variables
        // that will point to the created nodes

        var _scope = scope || {};

        // Recursive function that will read every node and when a node
        // contains the var attribute add a reference in the scope object

        function toScope(node, scope) {
            var children = node.children;
            for (var iChild = 0; iChild < children.length; iChild++) {
                if (children[iChild].getAttribute('var')) {
                    var names = children[iChild].getAttribute('var').split('.');
                    var obj = scope;
                    while (names.length > 0) {
                        var _property = names.shift();
                        if (names.length == 0) {
                            obj[_property] = children[iChild];
                        } else {
                            if (!obj.hasOwnProperty(_property)) {
                                obj[_property] = {};
                            }
                            obj = obj[_property];
                        }
                    }
                }
                toScope(children[iChild], scope);
            }
        }

        toScope(node, _scope);

        if (html.constructor != String) {
            return html;
        }
        // If the node in the highest hierarchy is one return it

        if (node.childNodes.length == 1) {
            // if a scope to add node variables is not set
            // attach the object we created into the highest hierarchy node

            // by adding the nodes property.
            if (!scope) {
                node.childNodes[0].nodes = _scope;
            }
            return node.childNodes[0];
        }

        // if the node in highest hierarchy is more than one return a fragment
        var fragment = document.createDocumentFragment();
        var children = node.childNodes;

        // add notes into DocumentFragment
        while (children.length > 0) {
            if (fragment.append) {
                fragment.append(children[0]);
            } else {
                fragment.appendChild(children[0]);
            }
        }

        fragment.nodes = _scope;
        return fragment;
    }



    constructor() {}

    //AES: Advanced Encryption Standard  
    //_tipo:1 (Encriptar); _tipo_2(Desencriptar)
    static generateAES = function(_text, _type) {
        var _return = "";
        var key = CryptoJS.enc.Utf8.parse('franco');
        var fecha = new Date();
        var fechaansi = Util.Date3Ansi(fecha);
        var ivfecha = "1998102720190705"; //fechaansi + fechaansi;
        var iv = CryptoJS.enc.Utf8.parse(ivfecha);
        if (_type == 1) {
            var encrypted = CryptoJS.AES.encrypt(
                _text,
                key, {
                    iv: iv,
                    mode: CryptoJS.mode.CBC,
                    padding: CryptoJS.pad.Pkcs7
                }
            );
            _return = encrypted.toString();
            //_return = _return.replace(/\+/g, '|');
        } else {

            //_text = _text.replace(/|/g, '+');

            var decrypted = CryptoJS.AES.decrypt(
                _text,
                key, {
                    iv: iv,
                    mode: CryptoJS.mode.CBC,
                    padding: CryptoJS.pad.Pkcs7
                }
            );
            _return = decrypted.toString(CryptoJS.enc.Utf8);
        }
        return _return;
    }


    static Date3Ansi = function(Fecha) {
        try {
            return Fecha.getFullYear().toString() + Util.FormatoDigitos(Fecha.getMonth() + 1, 2) + Util.FormatoDigitos(Fecha.getDate(), 2);
        } catch (e) {
            return "";
        }
    };

    static FormatoDigitos = function(Numero, Digitos) {
        try {
            while (Numero.toString().length < Digitos) {
                Numero = "0" + Numero.toString();
            }
            return Numero.toString();
        } catch (e) {
            return Numero.toString();
        }
    };

    static convertirTextoEnArray = (data) => {
        return data.split('¬').map(x => x.split('|'));
    };

    static obtenerParametroQueryString = (parametro) => {
        let resultado = "";
        let urlString = window.location.href;
        //alert(urlString);
        if (urlString.indexOf("?") >= 0) {
            let paramString = urlString.split('?')[1];
            let params_arr = paramString.split('&');
            for (let i = 0; i < params_arr.length; i++) {
                let pair = params_arr[i].split('=');
                if (pair[0] == parametro) {
                    resultado = pair[1]
                }
            }
        }
        return resultado;
    }

    static obtenerOptionsDeLista = (lista) => {
        if (lista == undefined || lista == null || lista.length == 0 || lista[0] == "") {
            return "";
        }
        let tipo = "";
        for (let i = 0, j = lista.length; i < j; i++) {
            const valores = lista[i].split('|');
            tipo += "<option value='" + valores[0] + "'>" + valores[1] + "</option>";
        }
        return tipo;
    };
    static obtenerJsonDeLista = (lista) => {
        if (lista == undefined || lista == null || lista.length == 0 || lista[0] == "") {
            return "";
        }
        let tipo = "";
        for (let i = 0, j = lista.length; i < j; i++) {
            const valores = lista[i].split('|');
            tipo += ",{\"id\":\"" + valores[0] + "\",\"text\":\"" + valores[1] + "\"}";
        }
        if (tipo.length > 0) tipo = tipo.substring(1);
        tipo = '[' + tipo + ']';
        return tipo;
    };

    //     static actualizarListaNotificaciones = async () => {
    //         const idUser = document.querySelector('#hdfIdUsuario').value;

    //         const [profile, pendingEvaluation, myObjectives] = await Promise.all([
    //             SecurityProvider.pendingApprovals(),
    //             SecurityProvider.getPendingEvaluations(idUser),
    //             SecurityProvider.getMyObjNotification(idUser)
    //         ]);

    //         let myPendingObj = [{
    //             isMailSent: myObjectives.obj.isSent,
    //             idEmployee: profile.profile.idEmployee
    //         }].filter(e => e.isMailSent == 0);

    //         let pendingActivity = profile.pendingActivity.filter(k => k.pending !== 0 && k.typePerformance !== "Confirmación de Mis Objetivos");
    //         let pendingEvaluations = (pendingEvaluation.complete)
    //             ? pendingEvaluation.employeesList.filter(e => e.stateCode === 'PEN' || e.stateCode === 'CUR')
    //             : [];
    //         let totalPending = pendingActivity.length;


    //         totalPending += pendingEvaluations.length;
    //         totalPending += myPendingObj.length;

    //         //const raiz = hdfRaiz.value;
    //         const raiz = '/'

    //         let html = "";


    //         html = `
    //         ${totalPending > 0 ? `
    //         <div class="header-navheading"> 
    //             <p class="main-notification-text">
    //                 <i class="ion ion-merge"></i> ACTIVIDAD PENDIENTE<span class="badge bg-pill bg-primary ms-3">${totalPending}</span>
    //             </p>
    //         </div>
    //         `: ''}


    //         <!-- objetivos del usuario -->
    //         ${myPendingObj.map(e => {
    //             return `
    //             <div class="main-notification-list redirect-objetives" data-id-employee="${e.idEmployee}">
    //                     <div class="media new">
    //                         <div class="main-img-user online">
    //                             <img alt="avatar" src="${raiz}Statics/img/profile/pendiente_employer.png">
    //                         </div>
    //                     <div class="media-body"> 
    //                     <p><strong>Módulo: Desempeño</strong></p> 
    //                     <p class="text-danger">Pendiente: Envío de mis objetivos</p> 
    //                 </div>
    //                 </div>
    //             </div>`
    //         }).join('')}


    //         <!-- objetivos de sus colaboradores -->
    //         ${pendingActivity.map(k => {
    //             return `
    //             <div class="main-notification-list redirect-objetives" data-id-employee="${k.iEmployeeId}">
    //                     <div class="media new">
    //                         <div class="main-img-user online">
    //                             <img alt="avatar" src="${raiz}Statics/img/profile/pendiente_employer.png">
    //                         </div>
    //                     <div class="media-body">
    //                     <p ><strong>Módulo: ${k.modulo}</strong></p>
    //                     <p>${k.typePerformance} </p>
    //                     <span class="text-danger">Pendiente (${k.pending}) de (${k.total}) <span class="text-danger"> Avance: ${k.porcentaje*100} %</span>
    //                 </div>
    //                 </div>
    //             </div>`
    //         }).join('')}



    //         <!-- evaluaciones pendientes del usuario -->
    //         ${pendingEvaluations.map(i => {
    //         return `
    //             <div class="main-notification-list redirect-evaluations" data-id-tab="${i.code}">
    //                 <div class="media new">
    //                     <div class="main-img-user online">
    //                         <img alt="avatar" src="${raiz}Statics/img/profile/pendiente_employer.png">
    //                     </div>
    //                     <div class="media-body">
    //                         <p ><strong>Módulo: ${i.modulo}</strong></p>
    //                         <p>Evaluación pendiente de: ${i.name} (${i.state})</p>
    //                         <!--span class="text-danger">Pendiente (cambiar3) de (${totalPending}) </span-->
    //                         <span class="text-danger"> Fecha límite: ${i.evaluationEnd.toDate()}</span><div class="badge bg-primary">${i.evaluationEnd.toRelativeFromToday()}</div>
    //                     </div>
    //                 </div>
    //             </div>`
    //         }).join('')}
    // `;

    //         if (pendingActivity.length == 0 && pendingEvaluation.length == 0) {
    //             $("#dvNotification").hide();
    //         }
    //         else {
    //             window.top.$("#dvNotification").show();
    //             if (totalPending > 0) {
    //                 window.top.$(".dv-contenido-notificacion-total").html(totalPending);
    //             } else {
    //                 window.top.$(".dv-contenido-notificacion-total").html('');
    //             }

    //             window.top.$("#dv-contenido-notificacion").html(html);


    //             //#region redirect Objetives

    //             if (pendingActivity.filter(f => f.pending > 0 && f.total > 0)) {

    //                 window.top.$(".redirect-objetives").click(function () {
    //                     let idEmployee = $(this).attr("data-id-employee")
    //                         window.top.document.querySelectorAll('.hidden-notification').forEach(ocultar => { if (ocultar.classList.contains('show')) ocultar.classList.remove('show') })
    //                         window.top.document.querySelectorAll('.menuItemContainer').forEach(link => {
    //                             if (link.querySelector('a').dataset.url == 'pages/HumanResourceManagement/objectives.js') {
    //                                 link.classList.add('active')
    //                             } else {
    //                                 link.classList.remove('active')
    //                             }
    //                         });
    //                         //window.localStorage.setItem('ieinfo', btn.dataset.idEmployee);
    //                     window.parent.document.querySelector('#ifContenido').setAttribute("src", hdfRaiz.value+ "Principal/Contenido?url=" + 'pages/HumanResourceManagement/objectives.js' + (idEmployee != profile.idEmployee ? '&ieinfo=' + idEmployee : ''));
    //                 });
    //             }

    //             if (pendingEvaluations.length > 0) {

    //                 window.top.$(".redirect-evaluations").click(function () {
    //                     let a = $(this).attr("data-id-tab");
    //                     let idEmployee = $(this).attr("data-id-idEmployee");

    //                     window.top.document.querySelectorAll('.hidden-notification').forEach(ocultar => { if (ocultar.classList.contains('show')) ocultar.classList.remove('show') })
    //                     window.top.document.querySelectorAll('.menuItemContainer').forEach(link => {
    //                         if (link.querySelector('a').dataset.url == 'pages/HumanResourceManagement/Performance/evaluation.js') {

    //                             link.classList.add('active')
    //                         } else {
    //                             link.classList.remove('active')
    //                         }
    //                     });
    //                     window.parent.document.querySelector('#ifContenido').setAttribute("src", hdfRaiz.value + "Principal/Contenido?url=" + 'pages/HumanResourceManagement/Performance/evaluation.js&tabIndex=' + a + (idEmployee != profile.idEmployee ? '&ieinfo=' + idEmployee : ''));
    //                 });

    //             }
    //             //#endregion
    //         }
    //     };
}

export default Util;