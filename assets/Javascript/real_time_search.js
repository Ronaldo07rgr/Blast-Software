$(document).ready(function () { // Buscador de proveedores

    $("#searchprov").on("input", function () {
        buscarProveedor();
    });

    function buscarProveedor() {
        var searchTerm = $("#searchprov").val();

        $.ajax({
            type: "post",
            url: "?b=profile&s=buscarProveedor",
            data: {
                buscar_proveedor: searchTerm
            }
        }).done(function (response) {
            $("#resultados-proveedor").html(response);
        });
    }

    // Buscador de Colaboradores
    $("#searchcol").on("input", function () {
        buscarEmpleado();
    });

    function buscarEmpleado() {
        var searchTerm = $("#searchcol").val();

        $.ajax({
            type: "post",
            url: "?b=profile&s=buscarColaborador",
            data: {
                buscar_empleado: searchTerm
            }
        }).done(function (response) {
            $("#resultados-empleados").html(response);
        });
    }

    // Buscador de clientes
    $("#searchcli").on("input", function () {
        buscarClientes();
    });

    function buscarClientes() {
        var searchTerm = $("#searchcli").val();

        $.ajax({
            type: "post",
            url: "?b=profile&s=buscarClientes",
            data: {
                buscar_cliente: searchTerm
            }
        }).done(function (response) {
            $("#resultados-clientes").html(response);
        });
    }

    // Buscador de clientes para doctor
    $("#searchcli2").on("input", function () {
        buscarClientes2();
    });

    function buscarClientes2() {
        var searchTerm = $("#searchcli2").val();

        $.ajax({
            type: "post",
            url: "?b=profile&s=buscarClientes2",
            data: {
                buscar_cliente: searchTerm
            }
        }).done(function (response) {
            $("#resultados-clientes").html(response);
        });
    }

    // Buscador de mascotas
    $("#searchmas").on("input", function () {
        buscarMascotas();
    });

    function buscarMascotas() {
        var searchTerm = $("#searchmas").val();

        $.ajax({
            type: "post",
            url: "?b=profile&s=buscarMascotas",
            data: {
                buscar_mascota: searchTerm
            }
        }).done(function (response) {
            $("#resultados-mascotas").html(response);
        });
    }

    // Buscador de mascotas 2
    $("#searchmas2").on("input", function () {
        buscarMascotas2();
    });

    function buscarMascotas2() {
        var searchTerm = $("#searchmas2").val();

        $.ajax({
            type: "post",
            url: "?b=profile&s=buscarMascotas2",
            data: {
                buscar_mascota: searchTerm
            }
        }).done(function (response) {
            $("#resultados-mascotas").html(response);
        });
    }

    // Buscador de mascotas 3
    $("#searchmas3").on("input", function () {
        buscarMascotas3();
    });

    function buscarMascotas3() {
        var searchTerm = $("#searchmas3").val();

        $.ajax({
            type: "post",
            url: "?b=profile&s=buscarMascotas3",
            data: {
                buscar_mascota: searchTerm
            }
        }).done(function (response) {
            $("#resultados-mascotas").html(response);
        });
    }

    // Buscador de cita
    $("#searchcita").on("input", function () {
        buscarCita();
    });

    function buscarCita() {
        var searchTerm = $("#searchcita").val();

        $.ajax({
            type: "post",
            url: "?b=profile&s=buscarCita",
            data: {
                buscar_cita: searchTerm
            }
        }).done(function (response) {
            $("#resultados-cita").html(response);
        });
    }
});
