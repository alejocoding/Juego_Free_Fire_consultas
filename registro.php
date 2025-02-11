<div class="red_card">
    <div class="image-container">
        <img src="assets/img/ORION.png" alt="">
        <div class="info-overlay">
            <h1>ORION</h1>
            <p>Un guerrero oscuro que devora todo. ¿Controlas su poder o te consume?</p>
        </div>
    </div>
    <style>
        .image-container {
    position: relative;
    display: inline-block;
    width: 100%;
}

.image-container img {
    width: 100%;
    display: block;
}

.info-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); /* Fondo negro con transparencia */
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    opacity: 0; /* Oculto por defecto */
    transition: opacity 0.3s ease-in-out;
}

/* Mostrar la capa cuando el usuario pase el cursor */
.image-container:hover .info-overlay {
    opacity: 1;
}
    </style>
</div>