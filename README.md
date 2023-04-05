# API RESTful en Laravel 
# Primer Campeonato Mundial de Toros y Vacas
## Introducción

Toros y vacas es un juego tradicional inglés a lápiz y papel para dos jugadores cuyo objetivo es adivinar un número constituido por cuatro dígitos. 
En una hoja de papel, un jugador escribe un número de 4 dígitos y lo mantiene en secreto. Las cifras deben ser todas diferentes, no se debe repetir ninguna dentro del mismo número. El otro jugador trata de adivinar el número secreto en varios intentos que son anotados y numerados. 
En cada intento anota una cifra de cuatro dígitos completa, ésta es evaluada por el jugador que guarda el número secreto. Si una cifra está presente y se encuentra en el lugar correcto es evaluada como un toro, si una cifra está presente pero se encuentra en un lugar equivocado es evaluada como una vaca. La evaluación se anota al lado del intento y es pública. 

Ejemplo:

Número secreto: 4271

|Intentos| Número | Evaluación |          
|--------|--------|------------|          
|1(*)    |   1234 |       1T2V | 
|2       |   5678 |       1T0V |          
|3       |   9012 |       1T0V |          
|4       |   9087 |       0T2V |          
|.       |   .... |       .... |          
|.       |   .... |       .... |          
|8       |   4271 |       4T0V |          

(*) "1" toro y "2" vacas, el toro es "2" las vacas son "4" y "1" 

## Implementacción
Con el propósito de automatizar el Primer Campeonato Mundial de Toros y Vacas se propone la implementación de la API RESTful en Laravel.  

Al adivinarse el número termina la partida. 
Se necesita crear una RESTful API usando Laravel para ser usada en el Primer Campeonato Mundial de Toros y Vacas. Los requerimientos son los siguientes: 
1. Use el prefijo /game/ para todos los endpoints. 
2. Use una base de datos SQLite para almacenar los juegos creados y la información relacionada que necesite. No guarde de forma permanente todas las combinaciones recibidas. 
3. Especifique en la configuración de la aplicación una variable para especificar el tiempo máximo para solucionar el reto antes de declarar “Game Over” 
4. Implemente un endpoint por cada una de las siguientes funcionalidades: 
<!-- UL-->
a. Crear un nuevo juego. Los datos requeridos serán: usuario y edad. Retorna un identificador único para cada juego. 
<!-- UL-->
b. Proponer combinación: Validar los dígitos propuestos y retornar el resultado según las reglas descritas. Usar diferentes códigos HTTP según las posibles respuestas: 
<!-- UL-->
I. Resultado de la comprobación: 
<!-- UL-->
1. Combinación numérica propuesta. 
2. Cantidad de toros y vacas alcanzados 
3. Número de intentos alcanzados 
4. Tiempo disponible en el juego.
5. Evaluación: “Tiempo en segundos” / 2 + “Cantidad de Intentos” 
6. Ranking del juego actual con respecto a otros juegos según su evaluación. Se ubican primero siempre los juegos ganados. 
<!-- UL-->
II. Combinación duplicada: los dígitos ya fueron enviados previamente en el mismo orden. 
<!-- UL-->
III. Game Over: El tiempo máximo del juego fue alcanzado. Retornar la combinación que se trataba de “adivinar” 
<!-- UL-->
c. Eliminar datos del juego: Se debe especificar el identificador único del juego. d. Obtener respuesta previa según el número del intento. La respuesta sería similar a la que retorna el endpoint: Proponer combinación. 

## Herramientas utilizadas

* Laravel (Versión: 10.5.0) 
* PHP (Versión: 8.1.6)
* XAMPP (Versión: 3.3.0)
* Visual Studio Code (Versión: 1.77.0)
* Swagger Editor (Versión: 3.0.3)
* Postman (Versión: 10.12.0)
* SQLite - SQLiteStudio (Versión: 3.4.3)

## Autor:

Ricardo Ramírez Calzado 

## License

El frameworks Laravel es una aplicación de código abierto bajo la licencia [MIT license](https://opensource.org/licenses/MIT).
