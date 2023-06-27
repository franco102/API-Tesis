const format = {
    number: 'n_',
    boolean: 'b_',
    date: 'd_'
}

function parseObject(cadena, rowSep, colSep, props) {
    try {
        if (Boolean(rowSep) && Boolean(colSep)) {
            return Boolean(cadena) ?
                generateListObject(cadena, ['', rowSep, colSep].concat(props)) :
                [];
        } else if (Boolean(colSep)) {
            return Boolean(cadena) ?
                generateObject(cadena, colSep, props) :
                null;
        } else {
            return Boolean(cadena) ?
                generatePrimitive(props, cadena) :
                null;
        }
    } catch (e) {
        console.error(e, cadena, rowSep, colSep, props);
    }
}

function generateListObject(cadena, [nombre, sepFil, sepCol, ...props]) {
    let res = [];
    if (Boolean(cadena)) {
        if (Boolean(sepFil)) {
            res = cadena.split(sepFil).map(v =>
                generateObject(v, sepCol, props)
            );
        } else {
            res = generateObject(cadena, sepCol, props);
        }
    }
    return res;
}

function generateObject(cadena, sepCol, props) {
    const x = cadena.split(sepCol);
    let obj = {};
    for (var i = 0; i < props.length; i++) {
        if (props[i] == null) continue;
        if (typeof props[i] === 'string') {
            generatePrimitive(obj, props[i], x[i]);
        } else {
            obj[props[i][0]] = generarListaObjetos(x[i], props[i]);
        }
    }
    return obj;
}

function generatePrimitive(obj, prop, val) {
    try {
        switch (prop.substring(0, 2)) {
            case format.number:
                obj[prop.substr(2)] = val === '' || isNaN(val) ? null : +val;
                break;
            case format.boolean:
                obj[prop.substr(2)] = val === '1';
                break;
            case format.date:
                obj[prop.substr(2)] = toDate(val);
                break;
            default:
                obj[prop] = val;
        }
    } catch (e) {
        obj[prop] = val;
    }
}

function toDate(val) {
    if (val === '') return null;
    const [date, time] = val.split(' ');

    let year, month, day;
    if (date.includes('/')) {
        const [d, m, a] = date.split('/');
        year = +a;
        month = +m - 1;
        day = +d;
    } else {
        year = +date.substring(0, 4);
        month = +date.substring(4, 6) - 1;
        day = +date.substring(6, 8);
    }

    let hours = 0,
        minutes = 0,
        seconds = 0;
    if (Boolean(time)) {
        [hours, minutes, seconds] = time.split(':');
    }
    return new Date(year, month, day, hours, minutes, seconds);
}
export {
    format,
    parseObject,
    generatePrimitive,
    generateObject,
    generateListObject
}
/*
 ^ - Separador de resultados de primer nivel.
 ¬ - Separador entre data,  meta-data y meta-data de segundo nivel.
 ; - Separador de meta-data.

* EJECUTAR UNA CONSULTA
1. Devolver los valores de una consulta concatenados por filas y columnas con separador de elección (se recomienda separador complejos como por ejemploo ~*~ ó *|*).
2. Para transformar un objeto hijo dentro de la consulta principal se pude concatenar su meta-data luego de la meta-data del padre usando como llave el nombre del campo dentro del padre.
3. Los sepadarodes de objeto (separadores de filas y columnas) deben tener una mayor complejidad a los separadores hijos.
4. Los separadores entre objetos hijos pueden ser los mismos.

 */