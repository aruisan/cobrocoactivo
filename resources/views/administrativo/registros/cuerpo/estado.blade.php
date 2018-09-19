
<ul class="progress-tracker progress-tracker--vertical">
    <center>
        <h4>Estado Actual del Registro</h4>
    </center>
    <br>
    @if($registro->secretaria_e == 0 and $registro->jcontratacion_e == 0 and $registro->jpresupuesto_e == 0 )
        <li class="progress-step is-active">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Secretaria</h4>
              Falta aprobación de la secretaria.
            </span>
        </li>
        <li class="progress-step">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Jefe de Contratación</h4>
              En espera.
            </span>
        </li>
        <li class="progress-step">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Jefe de Presupuesto</h4>
              En espera.
            </span>
        </li>
    @elseif($registro->secretaria_e == 3 and $registro->jcontratacion_e == 0 and $registro->jpresupuesto_e == 0 )
        <li class="progress-step is-complete">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Secretaria</h4>
              Ha sido finallizado.
            </span>
        </li>
        <li class="progress-step is-active">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Jefe de Contratación</h4>
              En espera.
            </span>
        </li>
        <li class="progress-step">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Jefe de Presupuesto</h4>
              En espera.
            </span>
        </li>
    @elseif($registro->secretaria_e == 3 and $registro->jcontratacion_e == 3 and $registro->jpresupuesto_e == 0 )
        <li class="progress-step is-complete">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Secretaria</h4>
              Ha sido finallizado.
            </span>
        </li>
        <li class="progress-step is-complete">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Jefe de Contratación</h4>
              Ha sido aprobado.
            </span>
        </li>
        <li class="progress-step is-active">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Jefe de Presupuesto</h4>
              En espera.
            </span>
        </li>
    @elseif($registro->secretaria_e == 3 and $registro->jcontratacion_e == 1 and $registro->jpresupuesto_e == 0 )
        <li class="progress-step is-complete">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Secretaria</h4>
              Ha sido finallizado.
            </span>
        </li>
        <li class="progress-step is-rechazado">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Jefe de Contratación</h4>
              Ha sido rechazado.
            </span>
        </li>
        <li class="progress-step">
            <span class="progress-marker"></span>
            <span class="progress-text">
              <h4 class="progress-title">Jefe de Presupuesto</h4>
              En espera.
            </span>
        </li>
    @else
    @endif
</ul>