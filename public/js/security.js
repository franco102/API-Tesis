import { default as rs } from './RequestServer.js';

// async function getUser(prueba) {
//     return await rs.exec('sps_all_user', { prueba }, false, false, false);
// }
//#region GET DATA EVALUACION
const Prueba = {
    getUser: async(prueba) => await rs.exec('sps_all_user', { prueba }, false, false, false),
    getProvincia: async(id) => await rs.exec('sps_provincia', { id }, false, false, false),
    deleteUser: async(id) => await rs.exec('spd__user', false, false, false)
}

export {
    Prueba,
}