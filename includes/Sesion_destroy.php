<div class="personajes">
        
        <img src="assets/img/garena.png" alt="" width="80px" height="80px" class="garena">

        <div class="Texto">
            <h1>PERSONAJES</h1>
            <p>Desde las profundidas de bermuda y el purgatorio, los mejores de los mejores justo aqui.</p>
        </div>

        <div class="personajes_fotos">

            <div class="red_card">

                <img src="assets/img/ORION.png" alt="">

                
                <h1>ORION</h1>

                <p>Un guerrero oscuro que devora todo. ¿Controlas su poder o te consume?</p>

            </div>

            <div class="red_card">

                <img src="assets/img/sonia.png" alt="" style="background-color: black;">
                <h1>SONIA</h1>
                <p>Precisión letal, un solo error y estás fuera. ¿Puedes esquivarla?</p>

            </div>

            <div class="red_card">
                
                <img src="assets/img/HAYATO.png" style="background-color: black;">
                <h1>HAYATO</h1>
                <p>Se vuelve más fuerte al borde de la muerte. ¿Te atreves a enfrentarlo?</p>

            </div>

            <div class="red_card">

                <img src="assets/img/MOCO.png" style="background-color: black;">
                <h1>MOCO</h1>
                <p>La hacker que todo lo ve. ¿Crees que puedes ocultarte?</p>

            </div>

        </div>
    </div>


    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}


.gif{
    position: relative;
    display: flex;
    justify-content: center;
    height: 800px;

   
}
.gif img{
    width: 100%;
    position: absolute;
    object-fit: cover;
    height: 800px;
    z-index: 0;
}

.gif img:first-child{
    z-index: 1;
    height: 211px;
    width: 50%;
    object-fit: cover;
    margin-top: 60px;
}

.jugar{
    z-index: 1;
    font-size: 22px;
    width: 280px;
    height: 68px;
    background-color: #f80000;
    border-radius: 0;
    color: white;
    border-color: black;
    border: 3px solid white;
    margin-top: 350px;
}



/* APARTADO DE LOS PERSONAJES */

.personajes{
    z-index: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    justify-items: stretch;
    text-align: center;
    width: 100%;
    height: 1000px;
    background-color: #0b0000;
}

.personajes>*{
   
    color: white;
}

.personajes_fotos{
    align-self: center;
    display: flex;
    flex-flow: wrap;
    justify-content: center;
    gap: 20px;
    width: 100%;
}
.red_card{
    display: block;
    justify-items: center;
    height: 500px;
    background-color: rgba(248, 0, 0, 0.5);
    width: 400px;
    padding: 20px;
}

.red_card h1{
    text-align: start;
    width: 100%;
    padding: 5px;
    margin-bottom: 20px;
}

.red_card p{
    font-size: 18px;
    width: 80%;
}

.Texto h1{
    font-size: 34px;
    padding: 50px;
}





.Texto p{
    font-size: 25px;
    margin-bottom: 80px;
}


