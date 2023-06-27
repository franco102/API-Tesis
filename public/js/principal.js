import { Prueba } from './security.js';

class Principal {
    constructor(contenedor) {
        this.componente = document.querySelector(contenedor);
        this.main();
    }
    async main() {
        let users = await Prueba.getUser(7269);
        let getProvincia = await Prueba.getProvincia(1);
        console.log(users);
        console.log(getProvincia);
        // this.init();
    }


}

window.onload = function() {
    try {
        new Principal("#page");
    } catch (err) {
        console.warn(err);
    }
}