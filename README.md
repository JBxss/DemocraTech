# Democratech - Sistema de Votaciones

Este proyecto implementa un sistema de votaciones en PHP, que permite registrar votantes, candidatos y realizar votaciones. El sistema asegura que se cumplan las restricciones establecidas en las especificaciones.

## Funcionalidades

1. **Registro de Votantes**
   - Registra información de votantes, incluyendo Nombre, Apellidos, Tipo de documento, Número de documento, Género y Localidad.

2. **Registro de Candidatos**
   - Registra información de candidatos, incluyendo Nombre, Apellidos, Tipo de documento, Género, Localidad y Partido al que pertenecen.

3. **Registro de Votos**
   - Permite a los votantes registrar su voto, asegurando las siguientes restricciones:
     a) Los votantes y candidatos deben estar registrados en el sistema.
     b) Un votante no puede votar por un candidato de una localidad diferente.
     c) Un votante no puede emitir más de un voto.

## Requisitos

- PHP 7.0 o superior.
- Base de datos MySQL o similar.

## Configuración

1. Clona el repositorio:

   ```bash
   git clone https://github.com/JBxss/Democratech.git
   ```

2. Configura la conexión a la base de datos en el archivo `index.php`.

3. Importa la estructura de la base de datos desde el archivo SQL proporcionado.

4. Inicia el servidor web y accede al sistema desde tu navegador.

## Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.

