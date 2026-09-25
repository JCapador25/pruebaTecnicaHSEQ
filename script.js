const formulario = document.getElementById("formularioUsuario");
const infoEnviada = document.getElementById("infoEnviada");

formulario.addEventListener("submit", function(event) {

    event.preventDefault(); //Evito que la página se recargue, el submit sin nada hace como F5

    const datos = new FormData(formulario); // en datos tengo {nombre:juliana,apellido:capador}

    fetch("data.php", { //Define una promesa, y el then retorna cuando la promesa retorna su valor async await también se puede usar
        method: "POST",
        body: datos
    }) //Abrir un endpoint a data.php, le envio el payload
    .then(response => response.json()) //lo que devuelva el php, .json la devuelve en un objeto .json devuelve una promesa
    .then(data => { //promesa .json() data ya es el objeto json lo que muestra el paylod del navegador guardado

        if (data.success) {

            infoEnviada.innerHTML = `
                <h2>Información enviada</h2>
                <p><strong>Nombre:</strong> ${data.usuario.nombre}</p>
                <p><strong>Apellido:</strong> ${data.usuario.apellido}</p>
                <p><strong>Teléfono:</strong> ${data.usuario.pais} ${data.usuario.telefono}</p>
                <p><strong>Correo:</strong> ${data.usuario.correo}</p>
                <p><strong>Profesión:</strong> ${data.usuario.profesion}</p>
                <p><strong>Área:</strong> ${data.usuario.area}</p>
                <p><strong>Jornada:</strong> ${data.usuario.jornada}</p>
                <p><strong>Información adicional:</strong> ${data.usuario.infoAdicional}</p>
            `;

        } else {

            infoEnviada.innerHTML = `
                <p>${data.message}</p>
            `;
        }

    })
    .catch(error => {

        console.error(error);

        infoEnviada.innerHTML = `
            <p>Ocurrió un error al enviar la información.</p>
        `;
    });
});